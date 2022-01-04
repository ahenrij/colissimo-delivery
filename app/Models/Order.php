<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * Return items associated to this order.
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Return status history for the order.
     */
    public function status_history() {
        return $this->belongsToMany(Status::class, 'histories')->withPivot('date');
    }
}
