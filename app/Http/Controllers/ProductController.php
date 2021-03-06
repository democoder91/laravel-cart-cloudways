<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('shop.index',[
            'products'=> Product::all()
        ]);
    }
    public function show($id){

        return view('shop.show',[
            'product'=>Product::findOrFail($id)
        ]);
    }

}
