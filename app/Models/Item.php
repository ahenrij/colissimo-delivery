<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    /**
     * Get the order to which this item belongs.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
