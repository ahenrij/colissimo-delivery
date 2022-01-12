<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
    public function history() {
        return $this->belongsToMany(Status::class, 'histories')->withPivot('date');
    }

    public function orderedStatusHistory() {
        return $this->history()->orderBy('id', 'desc')->get();
    }

    public function nextStatus() {
        return DB::table('status')->where('id', intval($this->orderedStatusHistory()[0]->id) + 1)->first();
    }
}
