<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
     protected $table = "tbl_stocks";
     protected $fillable = ['product_id','supplier_name','quantity'];
	
    //use HasFactory;
}
