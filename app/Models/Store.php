<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }


}
