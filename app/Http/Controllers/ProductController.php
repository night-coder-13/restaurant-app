<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
    }
    
    public function show(Product $product){
        $randProduct = Product::where('status' , 1)->get()->random(4);
        return view('product.show' , compact('product' , 'randProduct'));
    }
   
}
