<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['name', 'category', 'description'];

    // public function warehouse(): BelongsToMany {
    //     return $this->belongsToMany(Warehouse::class);
    // }

    public function wh_stocks(): HasMany {
        return $this->hasMany(ProductWarehouse::class,'product_id','id');
    }
}
