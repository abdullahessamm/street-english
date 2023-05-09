<?php

namespace App\Http\Controllers\Pages\Certificates\PublicCertificates;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificates\PublicCertificates\PublicCertificateLink;

class PublicCertificate extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.certificates.public-certificates.index');
    }

    public function create()
    {
        return view('pages.certificates.public-certificates.create');
    }

    public function show($certificates_link)
    {
        $publicCertificateLink = PublicCertificateLink::where('certificates_link', $certificates_link)->first();
        
        $publicCertificateLink == null ? $this->redierctTo('public-certificates') : true;

        return view('pages.certificates.public-certificates.show')->with('publicCertificateLink', $publicCertificateLink);
    }
}
