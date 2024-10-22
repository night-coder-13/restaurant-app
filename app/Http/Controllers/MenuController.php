<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request){
        $products = Product::search($request->search)->paginate(9);
        return view('menu.index' , compact('products' , 'request'));
    }
}
