<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request){
        $categoreis = Category::all();
        $products = Product::where('status' , 1)->where('quantity' , '>' , 0)->search($request->search)->filter()->paginate(9);
        return view('menu.index' , compact('products' , 'categoreis'));
    }
}
