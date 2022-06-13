<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_detail extends Model
{
    protected $guarded = [];

    //DEFINE ACCESSOR
    public function getSubtotalAttribute()
    {
        //NILAI DARI SUBTOTAL ADALAH QTY * PRICE
        return number_format($this->qty * $this->price);
    }

    //DEFINE RELATIONSHIPS
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
