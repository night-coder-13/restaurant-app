<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];

    public function getStatusAttribute($status)
    {
        switch ($status) {
            case '0':
                $status = 'در انتظار پرداخت';
                break;
            case '1':
                $status = 'در حال پردازش';
                break;
            case '2':
                $status = 'ارسال شده';
                break;
            case '3':
                $status = 'کنسل شده';
                break;
        }
        return $status;
    }

    public function getPaymentStatusAttribute($paymentStatus)
    {
        switch ($paymentStatus) {
            case '0':
                $paymentStatus = 'ناموفق';
                break;
            case '1':
                $paymentStatus = 'موفق';
                break;
        }
        return $paymentStatus;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orderitems');
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
