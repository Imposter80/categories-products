<?php

namespace App\Models\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   // use HasFactory;

    protected $primaryKey='id';
    protected $table='products';
    protected $fillable=['categoryid', 'productname', 'productdescription', 'price','created_at', 'updated_at'];
}
