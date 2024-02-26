<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    public function machine_type(){
        return $this->belongsTo(MachineType::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }
}
