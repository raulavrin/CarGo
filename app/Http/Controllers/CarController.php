<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        return view('pages.admin.car.add');
    }

    public function addCar(Request $request){
        // dd($request->all());

        $data["image"] = $request->image;
        $data["title"] = $request->title;
        $data["brand"] = $request->brand;
        $data["type"] = $request->type;
        $data["price"] = $request->price;
        $data["car_type"] = $request->car_type;
        $data["address"] = $request->address;
        $data["seats"] = $request->seats;
        $data["doors"] = $request->doors;
        $data["milage"] = $request->milage;
        $data["isActive"] = $request->isActive == "on" ? true : false;

        Car::create($data);
        return redirect()->route('carList');

    }

    public function carList(){
        $cars = Car::get();

        // dd($cars);

        return view('pages.admin.car.list', ["data"=>$cars]);
    }

    public function editCar($id){
        // dd($id);
        $car = Car::where(["id"=>$id])->first();
        // dd($car);
        
        return view('pages.admin.car.edit', ["car" => $car]);
    }

    public function carUpdate(Request $request){
        // dd($req->all());

        $data["image"] = $request->image;
        $data["title"] = $request->title;
        $data["brand"] = $request->brand;
        $data["type"] = $request->type;
        $data["price"] = $request->price;
        $data["car_type"] = $request->car_type;
        $data["address"] = $request->address;
        $data["seats"] = $request->seats;
        $data["doors"] = $request->doors;
        $data["milage"] = $request->milage;
        $data["isActive"] = $request->isActive == "on" ? true : false;

        Car::where(['id'=>$request->id])->update($data);

        return redirect()->route("carList");
    }

    public function carDelete($id){
        Car::where(["id"=>$id])->delete();

        return redirect()->back();
    }
}

