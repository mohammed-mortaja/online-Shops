<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
    public function owners()
    {
        return $this->hasMany(Owner::class);
    }
    public function stores(){
        return $this->hasMany(Store::class);
    }
}
