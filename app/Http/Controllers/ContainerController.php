<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContainerController extends Controller
{
    //
    public function get_search(Request $request){
        $product_id = $request->product_id;
        $search_name = $request->search_name;
        $list_item = Product::where(
            [
                ['name', 'like', '%' . $search_name . '%'],
                ['product_cat_id', $product_id],
            ]
        )->get();
        
        if(count($list_item) > 0){
            foreach ($list_item as $item){
                ?>
                        <li>
                            <a href="" title="" class="thumb">
                                <img src="<?php echo asset($item->thumbnail) ?>">
                            </a>
                            <a href="" title="" class="product-name"><?php echo $item->name ?></a>
                            <div class="price">
                                <span class="new"><?php echo number_format($item->price, 0, ',', '.') ?>đ</span>
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
