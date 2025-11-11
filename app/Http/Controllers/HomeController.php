<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
    $query = Car::where('isActive', true);

    // fetch distinct car types for the select in the view
    $types = Car::where('isActive', true)->distinct()->pluck('car_type');

        if ($request->filled('q')) {
            $q = trim($request->input('q'));
            $qLower = strtolower($q);
            $query->where(function($qbuilder) use ($qLower) {
                $qbuilder->whereRaw('LOWER(title) LIKE ?', ["%{$qLower}%"]) 
                         ->orWhereRaw('LOWER(address) LIKE ?', ["%{$qLower}%"]) 
                         ->orWhereRaw('LOWER(type) LIKE ?', ["%{$qLower}%"]) 
                         ->orWhereRaw('LOWER(car_type) LIKE ?', ["%{$qLower}%"]) 
                         ->orWhereRaw('LOWER(brand) LIKE ?', ["%{$qLower}%"]);
            });
        }

        if ($request->filled('vehicle_type')) {
            $vt = trim($request->input('vehicle_type'));
            $vtLower = strtolower($vt);
            $query->whereRaw('LOWER(car_type) LIKE ?', ["%{$vtLower}%"]);
        }

        // removed dedicated brand param in favor of single q input

        $cars = $query->get();

        return view('pages.home', ['properties'=>$cars, 'types' => $types]);
    }
}
