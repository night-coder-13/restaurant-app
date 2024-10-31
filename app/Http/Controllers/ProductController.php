<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
    }
    
    public function show(Product $product){
        $randProduct = Product::where('status' , 1)->where('quantity' , '>' , 0)->get()->random(4);
        $cart = session()->get('cart');
        $isCart= false;
        if(isset($cart[$product->id])){
            $isCart= $cart[$product->id]["qty"];
        }
        return view('product.show' , compact('product' , 'isCart' , 'randProduct'));
    }
   
}
