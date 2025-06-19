<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'fitzpatrick_type',
        'fitzpatrick_score',
        'baumann_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // kalo rolenya seller dia pny byk produk
    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }

    // kalo rolenya cust dia pny byk cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // kalo rolenya cust dia pny byk transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}