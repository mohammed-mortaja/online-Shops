<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory ;

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    // public function user()
    // {
    //     return $this->morphOne(User::class, 'actor', 'actor_type', 'actor_id', 'id');
    // }
}
