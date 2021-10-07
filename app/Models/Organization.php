<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Organization;
use App\Models\Articles;

class Organization extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'organization_name',
        'organization_logo',
        'organization_details',
        'organization_primary_color',
        'organization_secondary_color',
        'organization_slug',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

}
