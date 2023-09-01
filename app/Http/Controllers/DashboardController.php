<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_cat;
use App\Product;

//require_once app_path('Helpers/MenuHelper.php');

class DashboardController extends Controller
{
    //
    function show(){
        $list_products = Product::all();
        $product_cats = Product_cat::all();
        return view('home.dashboard', compact('product_cats', 'list_products'));
    }
}
