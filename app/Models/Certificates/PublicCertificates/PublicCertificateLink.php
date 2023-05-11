<?php

namespace App\Models\Certificates\PublicCertificates;

use Illuminate\Database\Eloquent\Model;

class PublicCertificateLink extends Model
{
    protected $table = 'public_certificate_links';

    protected $fillable = [
        'certificate_username', 'certificate_user_email', 'certificates_link',
    ];

    public function publicCertificates()
    {
        return $this->hasMany(PublicCertificate::class, 'public_certificate_link_id', 'id');
    }
}
