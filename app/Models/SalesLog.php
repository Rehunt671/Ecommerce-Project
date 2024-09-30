<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesLog extends Model
{
    protected $table = 'sales_log';

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity_sold',
        'total_price_sold',
        'sale_date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}