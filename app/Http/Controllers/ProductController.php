<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_cat;
use App\Product;
use App\Product_slide;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    //
    public function list(Request $request, $id){
        $list_catId = DB::table('product_cats')
            ->where('id', $id)
            ->get();
        $imgs = DB::table('product_cats')
            ->where('id', $id)
            ->get();
        $list_product = Product::where('product_cat_id', $id)
            ->get();
        $products = Product::paginate(10);
        $product_cats = Product_cat::all();
        $count = Product::count();
        return view('product.list', compact('list_catId', 'imgs', 'list_product', 'product_cats', 'products', 'count'));
    }
    function detail($id){
        $list_catId = DB::table('product_cats')
            ->where('id', $id)
            ->get();
        $list_product = Product::where('product_cat_id', $id)
            ->get();
        $list_products = Product::all();
        $product_cats = Product_cat::all();
        $products = Product::where('id', $id)->get();
        $slides = Product_slide::where('product_slide_id', $id)->get();
        $product_related = Product::all()->random(2);
        return view('product.detail', compact('list_catId', 'product_cats', 'list_products', 'list_product', 'products', 'slides', 'product_related'));
    }
    function get_price_order_by(Request $request){
        $value = $request->selectedValue;
        $product_id = $request->product_id;

        if($value == 1){
            $filter_price = Product::where(
                'product_cat_id', $product_id
            )
            ->orderByDesc('price')
            ->get();
        }

        if($value == 2){
            $filter_price = Product::where(
                'product_cat_id', $product_id
            )
            ->orderBy('price')
            ->get();
        }

        foreach($filter_price as $product){
        ?>
            <li>
                <a href="<?php echo route('product.detail', $product->id); ?>" title="" class="thumb">
                    <img src="<?php echo asset($product->thumbnail); ?>">
                </a>
                <a href="<?php echo route('product.detail', $product->id); ?>" title="" class="product-name"><?php echo $product->name; ?></a>
                <div class="price">
                    <span class="new"><?php echo number_format($product->price, 0, ',', '.'); ?>đ</span>
                </div>
            </li>
        <?php
        }
    }
    public function get_price(Request $request){ 
        $product_id = $request->product_id;
        $price = $request->price;
        $url = "http://localhost/laravelpro/unimart/";
        $filter_price = [];
        if($price == 1000000){
            $filter_price = Product::where(
                [
                    ['price', '<', 1000000],
                    ['product_cat_id', $product_id]
                ]
            )->get();
        }

        if($price == "1000000 AND 10000000"){
            $priceRange = explode(" AND ", $price);
            $lowerBound = $priceRange[0];
            $upperBound = $priceRange[1];

            $filter_price = Product::where(
                [
                    ['price', '>', $lowerBound],
                    ['price', '<', $upperBound],
                    ['product_cat_id', $product_id]
                ]
            )->get();
        }

        if($price == "10000000 AND 20000000"){
            $priceRange = explode(" AND ", $price);
            $lowerBound = $priceRange[0];
            $upperBound = $priceRange[1];

            $filter_price = Product::where(
                [
                    ['price', '>', $lowerBound],
                    ['price', '<', $upperBound],
                    ['product_cat_id', $product_id]
                ]
            )->get();
        }

        if($price == "20000000 AND 30000000"){
            $priceRange = explode(" AND ", $price);
            $lowerBound = $priceRange[0];
            $upperBound = $priceRange[1];

            $filter_price = Product::where(
                [
                    ['price', '>', $lowerBound],
                    ['price', '<', $upperBound],
                    ['product_cat_id', $product_id]
                ]
            )->get();
        }

        if($price == 30000000){
            $filter_price = Product::where(
                [
                    ['price', '>', 30000000],
                    ['product_cat_id', $product_id]
                ]
            )->get();
        }

        if(count($filter_price) > 0){
            foreach($filter_price as $product){
            ?>
                <li>
                    <a href="<?php echo route('product.detail', $product->id); ?>" title="" class="thumb">
                        <img src="<?php echo asset($product->thumbnail); ?>">
                    </a>
                    <a href="<?php echo route('product.detail', $product->id); ?>" title="" class="product-name"><?php echo $product->name; ?></a>
                    <div class="price">
                        <span class="new"><?php echo number_format($product->price, 0, ',', '.'); ?>đ</span>
                    </div>
                </li>
            <?php
            }
        }
        else{
            ?>
            <div class="text-center">
                <h5 class="text-danger">Hiện tại không có sản phẩm nào!</h5>
            </div>
            <?php
        }
    }
}
