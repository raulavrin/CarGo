<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function register()
    {
        return view('pages.register');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:6',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Success', 'Registration successful! Please login to continue.');
        return redirect()->route('login');
    }

    public function login()
    {
        if (Auth::check()) {
            // Check if user is admin
            if (Auth::user()->email === ADMIN_EMAIL) {
                return redirect()->route('carList');
            }
            return redirect()->route('home');
        }
        return view('pages.login');
    }

    public function loginCheck(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Check if user is admin
            if (Auth::user()->email === ADMIN_EMAIL) {
                Alert::success('Success', 'Welcome back, Admin!');
                return redirect()->route('carList');
            }
            
            Alert::success('Success', 'Login successful! Welcome back.');
            return redirect()->route('home');
        }

        Alert::error('Error', 'Invalid email or password. Please try again.');
        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        $userName = Auth::user()->name;
        $isAdmin = Auth::user()->email === ADMIN_EMAIL;
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($isAdmin) {
            Alert::success('Logged Out', 'Admin session ended. See you soon!');
        } else {
            Alert::success('Logged Out', 'You have been logged out successfully.');
        }

        // Redirect all users to home page
        return redirect()->route('home');
    }
}