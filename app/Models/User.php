<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Change this line
use Illuminate\Notifications\Notifiable; // Add this line if you use notifications
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable // Change this line
{
    use HasFactory, Notifiable; // Add Notifiable trait if needed

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    // Ensure password is hidden when returning user data
    protected $hidden = [
        'password', // Add password to hidden array
        'remember_token', // Include remember token for authentication
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
