<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'created_at',
    ];

    public function carts()
    {
        return $this->hasOne(Cart::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
