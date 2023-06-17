<?php

namespace App\Http\Controllers\Web;

use App\Models\Certificates\PublicCertificates\PublicCertificate;
use Illuminate\Http\Request;

class CertificateController extends Controller
{
    public function index()
    {
        return view('web.pages.certificate.index');
    }

    public function show($slug)
    {
        $publicCertificate = PublicCertificate::where('slug', $slug)->first();

        return view('web.pages.certificate.show')->with('publicCertificate', $publicCertificate);
    }

    public function search(Request $request)
    {
        $serial = $request->input('serial');

        $publicCertificate = PublicCertificate::where('serial', $serial)->first();

        $publicCertificate != null ? $this->redierctTo('search/certificate/'.$publicCertificate->slug) : $this->errorMsg('Certificate not found');
    }
}
