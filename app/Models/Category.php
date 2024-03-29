<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
    public function sub_categories(){
        return $this->hasMany(SubCategory::class);
    }
}
