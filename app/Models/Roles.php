<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_type',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
