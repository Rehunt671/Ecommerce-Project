<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];


    protected $hidden = [
        'password', 
        'remember_token',
    ];

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_items');
    }

    public function wishlists()
    {
        return $this->belongsToMany(Product::class, 'wishlists');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
