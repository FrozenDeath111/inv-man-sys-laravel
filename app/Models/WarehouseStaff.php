<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseStaff extends Model
{
    use HasFactory;
    public $table = "warehouse_staffs";
    public $timestamps = false;
    protected $fillable = ['warehouse_id', 'staff_id'];
}
