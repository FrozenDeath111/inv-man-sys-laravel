<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Warehouse;
use App\Models\WarehouseStaff;
use Illuminate\Http\Request;

class WarehouseStaffController extends Controller
{
    //
    public function index(){
        return view("warehouse_staff.dashboard");
    }

    public function show_pending(){
        $id = session()->get("id");
        $warehouse_id = WarehouseStaff::where("staff_id",$id)->first()->warehouse_id;

        $warehouse = Warehouse::find($warehouse_id);

        $pendings = History::where([
            ["storage", $warehouse->warehouse_name],
            ["status", "To Recieve"],
        ])->orWhere([
            ["storage", $warehouse->warehouse_name],
            ["status", "To Ship"],
        ])->get();
        
        return view("warehouse_staff.show_pending", [
            "pendings"=> $pendings,
        ]);
    }
}
