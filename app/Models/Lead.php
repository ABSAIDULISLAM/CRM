<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'creator' , 'id');
    }
    public function district()
    {
        return $this->belongsTo(Disctrict::class, 'district_id' , 'district_id');
    }
    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id' , 'thana_id');
    }
    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id' , 'union_id');
    }

    public function contactlead()
    {
        return $this->hasMany(ContactLead::class, 'lead_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
