<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function transaction_mode(){
        return $this->belongsTo(TransactionMode::class);
    }

    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function machine(){
        return $this->belongsTo(Machine::class);
    }
    
    public function additional_service(){
        return $this->belongsTo(AdditionalService::class, 'additional_service_id');
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

    public function garment(){
        return $this->belongsTo(Garment::class);
    }
}
