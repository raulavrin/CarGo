<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CarController extends Controller
{
    public function index(){
        return view('pages.admin.car.add');
    }

    public function addCar(Request $request){
        // Validate the request
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'car_type' => 'required|string',
            'address' => 'required|string',
            'seats' => 'required|integer',
            'doors' => 'required|integer',
            'milage' => 'required|numeric',
        ]);

        $data = [
            'title' => $request->title,
            'brand' => $request->brand,
            'type' => $request->type,
            'price' => $request->price,
            'car_type' => $request->car_type,
            'address' => $request->address,
            'seats' => $request->seats,
            'doors' => $request->doors,
            'milage' => $request->milage,
            'isActive' => $request->isActive == "on" ? true : false,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/cars'), $imageName);
            $data['image'] = 'uploads/cars/' . $imageName;
        } else {
            $data['image'] = null;
        }

        Car::create($data);
        
        Alert::success('Success', 'Vehicle added successfully!');
        return redirect()->route('carList');
    }

    public function carList(){
        $cars = Car::get();
        return view('pages.admin.car.list', ["data"=>$cars]);
    }

    public function editCar($id){
        $car = Car::where(["id"=>$id])->first();
        return view('pages.admin.car.edit', ["car" => $car]);
    }

    public function carUpdate(Request $request){
        // Validate the request
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric',
            'car_type' => 'required|string',
            'address' => 'required|string',
            'seats' => 'required|integer',
            'doors' => 'required|integer',
            'milage' => 'required|numeric',
        ]);

        $data = [
            'title' => $request->title,
            'brand' => $request->brand,
            'type' => $request->type,
            'price' => $request->price,
            'car_type' => $request->car_type,
            'address' => $request->address,
            'seats' => $request->seats,
            'doors' => $request->doors,
            'milage' => $request->milage,
            'isActive' => $request->isActive == "on" ? true : false,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            $car = Car::find($request->id);
            if ($car && $car->image && file_exists(public_path($car->image))) {
                unlink(public_path($car->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/cars'), $imageName);
            $data['image'] = 'uploads/cars/' . $imageName;
        }

        Car::where(['id'=>$request->id])->update($data);

        Alert::success('Success', 'Vehicle updated successfully!');
        return redirect()->route("carList");
    }

    public function carDelete($id){
        // Delete image file if exists
        $car = Car::find($id);
        if ($car && $car->image && file_exists(public_path($car->image))) {
            unlink(public_path($car->image));
        }

        Car::where(["id"=>$id])->delete();

        Alert::success('Success', 'Vehicle deleted successfully!');
        return redirect()->back();
    }
}