<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = 'promotions';
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'promotion_type',
        'discount',
        'buy_x',
        'get_y',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}