<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disctrict extends Model
{
    use HasFactory;

    protected $table = 'district_list';

    protected $gaurded = [];

    public $timestamps = false;
}