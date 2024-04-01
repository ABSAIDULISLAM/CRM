<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(subcategory::class,'sub_category_id', 'id');
    }





    // for delete subcatagory which same category id with subcategory id
    public function specification()
    {
        return $this->hasMany(Specification::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->specification()->delete();
        });
    }
}
