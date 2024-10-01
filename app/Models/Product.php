<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'stock',
        'status',
        'created_at',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category', 'id');
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function wishlists()
    {
        return $this->belongsToMany(User::class,'wishlists');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'cart_items');
    }

}
