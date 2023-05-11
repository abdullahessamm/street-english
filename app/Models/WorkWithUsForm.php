<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkWithUsForm extends Model
{
    protected $table = 'work_with_us_form';
    
    protected $fillable = [
        'fullname', 'email', 'phone_number', 'whatsapp_number', 'dob', 'address', 'matrial_status', 'military_status', 'personal_id_number', 'are_you_a', 'graduation_year', 'educational_background', 'why_are_you_applying', 'how_long_have_you_been_working', 'name_3_places', 'extra_qualifications', 'salaray', 'work_date_availability',
    ];
}
