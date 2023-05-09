<?php

namespace App\Http\Controllers\Pages\Certificates\PublicCertificates;

use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Image;
use App\Models\Certificates\PublicCertificates\PublicCertificateLink;
use App\Models\Certificates\PublicCertificates\PublicCertificate;

class AjaxPublicCertificate extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $publicCertificateLink = PublicCertificateLink::query();

        return Datatables::of($publicCertificateLink)
        ->editColumn('certificate_username', function ($publicCertificateLink) {
            return $publicCertificateLink->certificate_username;
        })
        ->editColumn('certificate_user_email', function ($publicCertificateLink) {
            return '<a href="'.route('public-certificate.show', [$publicCertificateLink->certificates_link]).'">'.$publicCertificateLink->certificate_user_email.'</a>';
        })
        ->editColumn('certificates_link', function ($publicCertificateLink) {
            return '<a href="'.route('public-certificate.show', [$publicCertificateLink->certificates_link]).'" target="_blank">رابط الشهادات</a>';
        })
        ->editColumn('created_at', function ($publicCertificateLink) {
            return date("Y-m-d h:i a", strtotime($publicCertificateLink->created_at));
        })
        ->rawColumns(['certificate_user_email', 'certificates_link'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $certificate_username = $request->input('certificate_username');
        $certificate_user_email = $request->input('certificate_user_email');
        $certificates_link = md5(uniqid());
        $certificates = $request->input('certificates');

        $publicCertificateLink = PublicCertificateLink::firstOrCreate(['certificate_user_email' => $certificate_user_email], [
            'certificate_username' => $certificate_username,
            'certificate_user_email' => $certificate_user_email,
            'certificates_link' => $certificates_link,
        ]);

        for($i = 0; $i < count($certificates); $i++)
        {
            $certificate_name = $certificates[$i]['certificate_name'];
            $count_certs = PublicCertificate::count();
            $cert_num = $count_certs + 1;
            $serial = "SE" . sprintf("%'.010d", $cert_num);


            PublicCertificate::create([
                'public_certificate_link_id' => $publicCertificateLink->id,
                'certificate_name' => $certificate_name,
                'serial' => "SE" . sprintf("%'.010d", $cert_num),
                'slug' => md5(uniqid()),
            ]);
        }

        $this->successMsg("تم انشاء شهادة للمستخدم : ".$certificate_username);

        $this->redierctTo('public-certificate/show/'.$certificates_link);
    }

    public function append(Request $request)
    {
        $public_certificate_link_id = $request->input('public_certificate_link_id');
        $certificates = $request->input('certificates');

        $certificate_username = PublicCertificateLink::where('id', $public_certificate_link_id)->first()->certificate_username;

        for($i = 0; $i < count($certificates); $i++)
        {
            $certificate_name = $certificates[$i]['certificate_name'];
            
            $count_certs = PublicCertificate::count();
            $cert_num = $count_certs + 1;
            $serial = "SE" . sprintf("%'.010d", $cert_num);
            

            PublicCertificate::firstOrCreate(['public_certificate_link_id' => $public_certificate_link_id, 'certificate_name' => $certificate_name],[
                'public_certificate_link_id' => $public_certificate_link_id, 
                'certificate_name' => $certificate_name,
                'serial' => $serial,
                'slug' => md5(uniqid()),
            ]);
        }

        $this->successMsg("تم اضافة شهادات");

        $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $public_certificate_id = $request->input('public_certificate_id');

        $publicCertificate  = PublicCertificate::where('id', $public_certificate_id)->first();
        
        $public_certificate_image = $this->getUniversalPath('public/images/public-certificates/'.$publicCertificate->certificate_image);

        file_exists($public_certificate_image) ? $this->removeFile($public_certificate_image) : true;

        $publicCertificate->delete();

        $this->successMsg("تم مسح الشهادة");
    }

    public function deleteAll(Request $request)
    {
        $public_certificate_link_id = $request->input('public_certificate_link_id');

        $publicCertificateLink = PublicCertificateLink::where('id', $public_certificate_link_id)->first();
        
        $publicCertificateLink == null ? $this->errorMsg("لا يوجد شهادات للمسح") : true;

        foreach($publicCertificateLink->publicCertificates as $publicCertificate)
        {
            $public_certificate_image = $this->getUniversalPath('public/images/public-certificates/'.$publicCertificate->certificate_image);
            
            file_exists($public_certificate_image) ? $this->removeFile($public_certificate_image) : true;
        }

        $publicCertificateLink->delete();

        $this->successMsg("تم مسح جميع الشهادات المتعلقة بهذا المستخدم");

        $this->redierctTo('public-certificates');
    }
}
