<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    
    // Define relationship with products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'ingredient_on_products')
                        ->withPivot('quantity', 'unit'); // Include unit in the pivot

    }
}
