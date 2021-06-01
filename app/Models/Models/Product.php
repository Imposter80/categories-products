<?php

namespace App\Models\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model
{
    use HasFactory;
    use Sortable;

    protected $primaryKey='id';
    protected $table='products';

    public function getCategoryNameAttribute($value)
    {
        return ($value);
    }
    public function setCategoryNameAttribute($value)
    {
        $this->attributes['category_name'] = ($value);
    }

    protected $fillable=['categoryid', 'productname', 'productdescription', 'price','created_at', 'updated_at'];




    //public $sortable = [ 'productname', 'productdescription','price','category_name', 'created_at'];

}
