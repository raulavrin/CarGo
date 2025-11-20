<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

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

        public function deleteAccount(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'delete_password' => 'required',
        ]);

        /** @var User $user */
        $user = Auth::user();

        if (!Hash::check($request->delete_password, $user->password)) {
            Alert::error('Error', 'Password is incorrect! Account deletion cancelled.');
            return redirect()->back();
        }

        if ($user->email === ADMIN_EMAIL) {
            Alert::error('Error', 'Admin account cannot be deleted!');
            return redirect()->back();
        }

        try {
            DB::beginTransaction();

            $userId = $user->id;

            // Manually delete all related records
            DB::table('appointments')->where('user_id', $userId)->delete();
            DB::table('subscriptions')->where('user_id', $userId)->delete();
            
            // Delete the user
            $user->delete();

            DB::commit();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Alert::success('Success', 'Your account has been permanently deleted.');
            return redirect()->route('home');

        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', 'Failed to delete account. Please try again or contact support.');
            return redirect()->back();
        }
    }
}