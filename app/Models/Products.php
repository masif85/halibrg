<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
     protected $table = "tbl_products";
     protected $fillable = ['user_id','category','name','code','cost','description','image',
    ];
    //use HasFactory;
}
