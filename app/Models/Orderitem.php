<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderitem extends Model
{
    use HasFactory;

    protected $table = 'orderitems';
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
