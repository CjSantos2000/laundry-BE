<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function transaction_mode(){
        return $this->belongsTo(TransactionMode::class);
    }

    public function shop_admin(){
        return $this->belongsTo(User::class, 'shop_admin_id');
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function additional_service(){
        return $this->belongsTo(AdditionalService::class);
    }

    public function garment(){
        return $this->belongsTo(Garment::class);
    }

    public function machine(){
        return $this->belongsTo(Machine::class);
    }
}
