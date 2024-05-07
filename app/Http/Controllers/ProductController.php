<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Product;
use App\Models\ProductWarehouse;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        //
        $warehouses = Warehouse::all();
        return view("admin.create_product", [
            "warehouses"=> $warehouses
        ]);
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            "name"=> ["required","unique:products"],
            "category"=>["required"],
            "description"=>["required"],
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category = $request->category;
        $product->description = $request->description;

        try {
            $product->save();
            
            $warehouse = Warehouse::find( $request->warehouse_id );

            $history = new History();
            $history->product_id = $product->id;
            $history->storage = $warehouse->warehouse_name;
            $history->status = 'To Recieve';
            $history->handled_by = 'admin';
            $history->quantity = $request->quantity;
            $history->dest = $warehouse->warehouse_name;

            $history->save();

            $product_warehouse = new ProductWarehouse();
            $product_warehouse->product_id = $product->id;
            $product_warehouse->warehouse_id = $warehouse->id;
            $product_warehouse->warehouse_stock = 0;

            $product_warehouse->save();

            return back()->with("success","New Product Created");
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    public function add_stock(Request $request){
        $history = new History();
        
        $history->product_id = $request->product_id;
        $history->storage = $request->warehouse_name;
        $history->status = "To Recieve";
        $history->handled_by = "admin";
        $history->quantity = $request->quantity;
        $history->dest = $request->warehouse_name;

        try {
            $history->save();
            return back()->with("success","Stock In Process");
        } catch (\Throwable $th) {
            //throw $th;
            return back()->with("error", $th->getMessage());
        }
    }

    public function show(Product $product)
    {
        //
        $products = Product::all();
        $warehouses = Warehouse::all();

        for ($i= 0; $i < count($products); $i++){
            unset($products[$i]['description']);
            $stock = array();
            $stock[] = $products[$i]->wh_stocks;
            $products[$i]['stocks'] = $stock;
        }

        return view('admin.show_products', [
            'products'=> $products,
            'warehouses'=> $warehouses
        ]);
    }

    public function show_one($id)
    {
        $product = Product::find( $id );
        return view('show_product', ['product'=> $product]);
    }

    public function show_requests(){
        $warehouses = Warehouse::all();
        $histories = History::where('status', 'Request')->get();
        return view('admin.show_requests',[
            'histories'=> $histories,
            'warehouses'=> $warehouses,
        ]);
    }

    public function accept_request(Request $request){
        $history = History::find($request->history_id);

        $history->status = 'To Ship';
        $history->storage = $request->warehouse_name;
        $history->handled_by = session()->get('username');

        try {
            //code...
            $history->save();
            return redirect()->back()->with('success','Request Accepted');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function reject_request($history_id){
        $history = History::find($history_id);
        $history->status = 'Rejected';
        $history->handled_by = session()->get('username');
        try {
            //code...
            $history->save();
            return redirect()->back()->with('success','Request Rejected');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
