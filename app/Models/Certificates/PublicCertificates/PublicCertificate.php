<?php

namespace App\Models\Certificates\PublicCertificates;

use Illuminate\Database\Eloquent\Model;

class PublicCertificate extends Model
{
    protected $table = 'public_certificates';

    protected $fillable = [
        'public_certificate_link_id', 'certificate_name', 'serial', 'certificate_type', 'certificate_image', 'slug',
    ];

    public function belongsToPublicCertificateLink()
    {
        return $this->belongsTo(PublicCertificateLink::class, 'public_certificate_link_id', 'id');
    }
}
