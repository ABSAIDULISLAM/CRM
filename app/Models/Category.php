<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];






    // for delete subcatagory which same category id with subcategory id
    // public function subcategories()
    // {
    //     return $this->hasMany(SubCategory::class);
    // }
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::deleting(function ($category) {
    //         $category->subcategories()->delete();
    //     });
    // }


}
