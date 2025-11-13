<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User; // Add this import

class UserProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var User $user */
        $user = Auth::user();
        return view('pages.user-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        /** @var User $user */
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        Alert::success('Success', 'Profile updated successfully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            Alert::error('Error', 'Current password is incorrect!');
            return redirect()->back();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        Alert::success('Success', 'Password changed successfully!');
        return redirect()->back();
    }
}