<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Store extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['store_name', 'store_manager_id'];

    public function store_manager(): HasOne
    {
        return $this->hasOne(Invuser::class,'id','store_manager_id');
    }
}
