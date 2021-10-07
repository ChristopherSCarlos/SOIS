<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\UserPermission;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_type',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function userpermission()
    {
        return $this->belongsToMany(UserPermission::class);
    }
}
