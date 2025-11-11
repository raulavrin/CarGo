<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class AppointmentController extends Controller
{
    public function getAppointment(){
        $properties = Car::where(["isActive"=>true])->get();
        return view("pages.get-appointment", ["properties"=>$properties]);
    }

    public function appointmentBooking(Request $request){
        // dd($request->all());
        $data["name"] = $request->name;
        $data["email"] = $request->email;
        $data["phone"] = $request->phone;
        $data["date"] = $request->date;
        $data["property_id"] = $request->property;
        $data["user_id"] = Auth::user()->id;
        $data["message"] = $request->notes;

        Appointment::create($data);

        Alert::success('Success', 'Booking request submitted successfully! We will contact you soon.');

        return redirect()->route('myAppointments');
    }

    public function getAppointmentList(){
        $appointments = Appointment::with("property")->with("user")->get();
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
        $myAppointments = Appointment::where(["user_id"=>Auth::user()->id])->with("property")->get();

        return view("pages.my-appointments", ["myAppointments"=>$myAppointments]);
    }
}