<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PDO;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function subscription(){
        return $this->hasOne(ShopAdminSubscription::class, 'shop_admin_id')->orderBy('id', 'desc');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class, 'shop_admin_id');
    }
    public function shop_admin(){
        return $this->hasOne(User::class, 'id', 'shop_admin_id');
    }
    public function services(){
        return $this->hasMany(Service::class, 'shop_admin_id');
    }
    public function transaction_modes(){
        return $this->hasMany(TransactionMode::class, 'shop_admin_id');
    }
    public function garments(){
        return $this->hasMany(Garment::class, 'shop_admin_id');
    }
}
