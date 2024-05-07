<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\ProductStore;
use App\Models\ProductWarehouse;
use App\Models\Store;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductWarehouseController extends Controller
{
    //
    public function accept_product($history_id){
        $history = History::find($history_id);
        $warehouse = Warehouse::where('warehouse_name', $history->storage)->first();
        $productWarehouse = ProductWarehouse::where([
            ['warehouse_id', $warehouse->id],
            ['product_id', $history->product_id],
        ])->first();

        $history->status = 'Recieved';
        $history->handled_by = session()->get('username');
        $productWarehouse->warehouse_stock += $history->quantity;

        try {
            $history->save();
            $productWarehouse->save();
            return back()->with("success","Data Processed Successfully");
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }

    public function ship_product($history_id){
        $history = History::find($history_id);
        
        $warehouse = Warehouse::where('warehouse_name', $history->storage)->first();
        $available_stock = ProductWarehouse::where([
            ['warehouse_id', $warehouse->id],
            ['product_id', $history->product_id],
        ])->first();

        if($available_stock->warehouse_stock < $history->quantity){
            return back()->with('error','Not Enough In Stock');
        }

        $store = Store::where('store_name', $history->dest)->first();

        $process_stock = ProductStore::where([
            ['store_id', $store->id],
            ['product_id', $history->product_id],
        ])->first();

        $process_stock->in_stock += $history->quantity;
        $available_stock->warehouse_stock -= $history->quantity;
        $history->status = 'Shipped';

        try {
            $history->save();
            $process_stock->save();
            $available_stock->save();
            return back()->with('success','Process Complete');
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with('error', $th->getMessage());
        }
    }
}
