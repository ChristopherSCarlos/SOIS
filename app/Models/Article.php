<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tag;
use App\Models\User;
use App\Models\Organization;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_title',
        'article_subtitle',
        'article_content',
        'type',
        'status',
        'image',
        'user_id',
    ];


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function organizations()
    {
        return $this->belongsToMany(Organization::class);
    }
}
