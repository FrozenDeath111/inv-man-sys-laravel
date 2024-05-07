<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Product;
use App\Models\ProductStore;
use App\Models\Store;
use Illuminate\Http\Request;

class ProductStoreController extends Controller
{
    //
    public function show_products(){
        $id = session()->get("id");
        $store = Store::where("store_manager_id", $id)->first();
        $storeProducts = ProductStore::where("store_id", $store->id)->get();
        foreach($storeProducts as $storeProduct){
            $product = Product::find($storeProduct->product_id);
            $storeProduct['product_name']= $product->name;
        }
        
        return view('store.show_products', [
            'storeProducts'=> $storeProducts,
        ]);
    }

    public function to_add_products(){
        $id = session()->get("id");
        $store = Store::where("store_manager_id", $id)->first();
        $storeProducts = ProductStore::where("store_id", $store->id)->get();

        $existing_products = array();
        foreach($storeProducts as $storeProduct){
            $existing_products[] = $storeProduct->product_id;
        }

        $products = Product::whereNotIn("id", $existing_products)->get();

        return view('store.to_add_products',[
            'products'=> $products,
            'store_id' => $store->id,
        ]);
    }

    public function add_product($product_id, $store_id){
        $storeProduct = new ProductStore();
        $storeProduct->product_id = $product_id;
        $storeProduct->store_id = $store_id;
        $storeProduct->in_stock = 0;
        $storeProduct->sale_stock = 0;

        $warehouse_stocks = Product::find($product_id)->wh_stocks;
        
        $total_stock = 0;
        foreach($warehouse_stocks as $stock){
            $total_stock += $stock->warehouse_stock;
        }

        $storeProduct->warehouse_stock = $total_stock;
        try {
            $storeProduct->save();
            return back()->with('success', 'Add To Store Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    public function request_stock(Request $request){
        $id = session()->get('id');
        $store = Store::where("store_manager_id", $id)->first();

        $history = new History();
        $history->product_id = $request->product_id;
        $history->storage = $store->store_name;
        $history->status = 'Request';
        $history->quantity = $request->requested_stock;
        $history->handled_by = session()->get('username');
        $history->dest = $store->store_name;

        try {
            $history->save();
            return back()->with('success','Requested Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    public function sale_stock(Request $request){
        $id = session()->get('id');
        $store = Store::where("store_manager_id", $id)->first();

        $storeProduct = ProductStore::where([
            ['product_id', $request->product_id],
            ['store_id', $store->id],
        ])->first();

        if($storeProduct->in_stock < $request->sale_stock){
            return back()->with('error','Not Enough In Stock');
        }

        $history = new History();
        $history->product_id = $request->product_id;
        $history->storage = $store->store_name;
        $history->status = "Sale";
        $history->quantity = $request->sale_stock;
        $history->handled_by = session()->get('username');
        $history->dest = 'Sold';

        $storeProduct->in_stock -= $request->sale_stock;
        $storeProduct->sale_stock += $request->sale_stock;

        try {
            $history->save();
            $storeProduct->save();
            return back()->with('success','Sold Successfully');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
