<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Category extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $table='categories';
    protected $sum=0;
    protected $count=0;
    protected $fillable=['categoryname', 'categorydescription','created_at', 'updated_at'];

    public $sortable = [ 'categoryname', 'categorydescription', 'created_at'];
}
