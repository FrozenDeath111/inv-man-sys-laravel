<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStore extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "product_store";
    protected $fillable = ['product_id','store_id','in_stock','sale_stock','warehouse_stock'];
    
}
