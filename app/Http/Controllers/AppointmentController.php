<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AppointmentController extends Controller
{
    public function getAppointment(Request $request){
    $cars = Car::where(["isActive"=>true])->get();
    
    // Get the selected car ID from the request
    $selectedCarId = $request->query('car_id');
    
    // Get authenticated user data if logged in
    $userData = null;
    if (Auth::check()) {
        $user = Auth::user();
        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone
        ];
    }
    
    return view("pages.get-appointment", [
        "cars" => $cars,
        "selectedCarId" => $selectedCarId,
        "userData" => $userData
        ]);
    }

    public function appointmentBooking(Request $request){
        
        $data["name"] = $request->name;
        $data["email"] = $request->email;
        $data["phone"] = $request->phone;
        $data["date"] = $request->date;
        $data["car_id"] = $request->car;
        $data["user_id"] = Auth::user()->id;
        $data["message"] = $request->notes;

        Appointment::create($data);

        Alert::success('Success', 'Booking request submitted successfully! We will contact you soon.');

        return redirect()->route('myAppointments');
    }

    public function getAppointmentList(){
        $appointments = Appointment::with("car")->with("user")->get();
        return view("pages.admin.appointment.list", ["appointments"=>$appointments]);
    }

    public function approveAppointment($id){
        $data["status"] = "approved";
        Appointment::where(["id"=>$id])->update($data);
        Alert::success('Success', 'Appointment approved successfully');

        return redirect()->back();
    }

    public function declineAppointment($id){
        $data["status"] = "declined";
        Appointment::where(["id"=>$id])->update($data);
        Alert::warning('Declined', 'Appointment has been declined');

        return redirect()->back();
    }

    public function myAppointments(){
        $myAppointments = Appointment::where(["user_id"=>Auth::user()->id])->with("car")->get();

        return view("pages.my-appointments", ["myAppointments"=>$myAppointments]);
    }
}