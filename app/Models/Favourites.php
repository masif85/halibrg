<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
     protected $table = "tbl_users_favorites";
     protected $fillable = ['product_id','user_id'];
    
    //use HasFactory;
}