<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
      protected $fillable = [
        'logo',
        'favicon',
        'site_title',
        'desc',
        'hotline',
        'time',
        'mail',
        'copyright',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'facebook_pixel',
        'google_analytics',
        'allow_indexing',
        'custom_header_scripts',
        'custom_footer_scripts'
    ];
}
