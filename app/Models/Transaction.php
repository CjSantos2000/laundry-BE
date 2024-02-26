<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function payment_method(){
        return $this->belongsTo(PaymentMethod::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function items(){
        return $this->hasMany(TransactionItem::class);
    }

    public function shop_admin(){
        return $this->belongsTo(User::class, 'shop_admin_id');
    }

    public function feedbacks(){
        return $this->hasMany(Feedback::class);
    }
}
