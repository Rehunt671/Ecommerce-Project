<?php

namespace App\Jobs;

use Illuminate\Support\Facades\DB;

class DeleteOldOrders
{
    public function __invoke()
    {
        // DB::table('orders')
        // ->where('created_at', '<', now()->subDays(7))
        // ->whereNull('purchase_date')
        // ->delete();
    }
}
