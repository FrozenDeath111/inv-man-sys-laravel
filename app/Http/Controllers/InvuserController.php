<?php

namespace App\Http\Controllers;

use App\Models\Invuser;
use App\Models\Store;
use App\Models\Warehouse;
use App\Models\WarehouseStaff;
use Illuminate\Http\Request;

class InvuserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $job_place = array();
        $warehouses = Warehouse::all();
        foreach ($warehouses as $warehouse) {
            $job_place[] = $warehouse->warehouse_name;
        }

        $stores = Store::all();
        foreach ($stores as $store) {
            $job_place[] = $store->store_name;
        }

        return view("admin.register",[
            'job_place' => $job_place,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "username"=>["required","unique:invusers"],
            "password"=>["required","min:8"],
            "role"=>["required"],
        ]);

        if($request->role < 2 || $request->role > 3){
            return back()->with("error","Role can only be 2 and 3");
        }

        $job_places = array();
        $warehouses = Warehouse::all();
        foreach ($warehouses as $warehouse) {
            $job_places[] = $warehouse->warehouse_name;
        }
        if($request->role == 2 ){
            if(!in_array($request->job_place, $job_places)){
                return back()->with("error","Warehouse Staff must be assigned to Warehouses");
            }
        }

        $job_places = array();
        $stores = Store::all();
        foreach ($stores as $store) {
            $job_places[] = $store->store_name;
        }
        if($request->role == 3 ){
            if(!in_array($request->job_place, $job_places)){
                return back()->with("error","Store Manager must be assigned to Stores");
            }
        }

        $user = new Invuser();
        $user->username = $request->username;
        $user->password = $request->password;
        $user->role = $request->role;

        try {
            $user->save();

            if($request->role == 2 ){
                $warehouseStaff = new WarehouseStaff();
                $warehouseStaff->staff_id = $user->id;
                $warehouseStaff->warehouse_id = $warehouses->where('warehouse_name', $request->job_place)->first()->id;
                $warehouseStaff->save();
            }

            if($request->role == 3 ){
                $store = Store::where('store_name', $request->job_place)->first();
                $store->store_manager_id = $user->id;
                $store->save();
            }

            return back()->with("success","New User Created");
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $invusers = Invuser::all();
        $users = array();
        foreach ($invusers as $invuser) {
            $user = array();
            $user['id'] = $invuser->id;
            $user['username'] = $invuser->username;
            $user['role'] = $invuser->role;
            $users[] = $user;
        }

        return view('admin.show_user', ['users'=> $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invuser $invuser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invuser $invuser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invuser $invuser)
    {
        //
    }
}
