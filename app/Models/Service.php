<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function additional_services(){
        return $this->hasMany(AdditionalService::class);
    }

    public function cart_items(){
        return $this->hasMany(CartItem::class);
    }
}
