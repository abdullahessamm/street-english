<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppConfig extends Model
{
    use HasFactory;

    protected $table = "app_config";
    
    protected $primaryKey = "key";
    
    protected $fillable = [
        "key", "value"
    ];

    protected $casts = [
        "value" => "json"
    ];

    protected $hidden = [
        "created_at"
    ];
}
