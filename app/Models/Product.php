<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ['quantity'];
    protected $appends = ['is_sale'];

    public function getIsSaleAttribute()
    {
        return $this->quantity > 0 && $this->sale_price !== 0 && $this->sale_price !== null && $this->date_on_sale_from < Carbon::now() && $this->date_on_sale_to > Carbon::now();
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class)->where('deleted_at', null);
    }

    // تعریف یک اسکوب
    public function scopeSearch($query, $search)
    {
        $query->where('name', 'LIKE', '%' . trim($search) . '%');
    }
    public function scopeFilter($query)
    {
        if (request()->has('category')) {
            $query->where('category_id', request()->category);
        }

        if (request()->has('storBy')) {
            switch (request()->storBy) {
                case 'max';
                    $query->orderBy('price', 'desc');
                    break;
                case 'min';
                    $query->orderBy('price');
                    break;
                case 'bestseller';
                    $orders = Order::where('payment_status', 1)->with('products')->get();
                    $productIds = [];
                    foreach ($orders as $order) {
                        foreach ($order->products as $product) {
                            array_push($productIds, $product->id);
                        }
                    }

                    // dd($productIds, array_count_values($productIds), array_keys(array_count_values($productIds)));
                    $query->whereIn('id', array_keys(array_count_values($productIds)));
                    $query;
                    break;
                case 'sale';
                    $query->where('quantity', '!=', 0)->where('sale_price', '!=', 0)->where('date_on_sale_from', '<', Carbon::now())->where('date_on_sale_to', '>', Carbon::now());
                    break;
                default;
                    $query;
            }
        }
        return $query;
    }
}
