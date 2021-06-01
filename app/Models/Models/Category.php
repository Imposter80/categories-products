<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Kyslik\ColumnSortable\Sortable;


class Category extends Model
{
    use HasFactory;
   // use Sortable;

    protected $primaryKey='id';
    protected $table='categories';

    public function getAmountProductAttribute($value)
    {
        return ($value);
    }

    public function setAmountProductAttribute($value)
    {
        $this->attributes['amount_product'] =($value);
    }

    public function getSumProductAttribute($value)
    {
        return ($value);
    }

    public function setSumProductAttribute($value)
    {
        $this->attributes['sum_product'] =($value);
    }


    protected $fillable=['categoryname', 'categorydescription','created_at', 'updated_at'];

    //public $sortable = [ 'categoryname', 'categorydescription','amount_product','sum_product', 'created_at'];

}
