<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultInterface extends Model
{
    use HasFactory;

    protected $fillable = [
        'homepage_title',
        'homepage_subtitle',
        'homepage_details',
        'homepage_logo',
        'homepage_background_image',
        'homepage_text_color',
        'homepage_background_color_1',
        'homepage_background_color_2',
        'homepage_background_color_3',
    ];
}
