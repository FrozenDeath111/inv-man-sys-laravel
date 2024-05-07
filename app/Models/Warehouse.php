<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Warehouse extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['warehouse_name'];

    // public function products(): BelongsToMany {
    //     return $this->belongsToMany(Product::class);
    // }
}
