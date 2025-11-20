<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// admin email constant
define('ADMIN_EMAIL', 'admin@university.edu');

Route::get('/', [HomeController::class, 'index'])->name("home");

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/dashboard', function () {
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return view('pages.admin.index');
})->name("dashboard");

Route::get('/dashboard/add-car', function(){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->make(CarController::class)->index();
});

Route::get('/dashboard/edit-car/{id}', function($id){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->call([app()->make(CarController::class), 'editCar'], ['id' => $id]);
})->name('editCar');

Route::get('/dashboard/car-list', function(){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->make(CarController::class)->carList();
})->name('carList');

Route::post('/add-car', [CarController::class, 'addCar']);
Route::post('/edit-car', [CarController::class, 'carUpdate'])->name("carUpdate");
Route::get('/delete-car/{id}', [CarController::class, 'carDelete'])->name("carDelete");

Route::get('/register', [AuthController::class, 'register'])->name("register");
Route::post('/register', [AuthController::class, 'signup'])->name("signup");
Route::get('/login', [AuthController::class, 'login'])->name("login");
Route::post('/login', [AuthController::class, 'loginCheck'])->name("loginCheck");
Route::get('/logout', [AuthController::class, 'logout'])->name("logout");

Route::get('/get-appointment', [AppointmentController::class, 'getAppointment'])->name("getAppointment");
Route::post('/get-appointment', [AppointmentController::class, 'appointmentBooking'])->name("appointmentBooking");

Route::get('/dashboard/appointment-list', function(){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->make(AppointmentController::class)->getAppointmentList();
})->name("getAppointmentList");

Route::get('/appointment-approve/{id}', function($id){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->call([app()->make(AppointmentController::class), 'approveAppointment'], ['id' => $id]);
})->name("approveAppointment");

Route::get('/appointment-decline/{id}', function($id){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->call([app()->make(AppointmentController::class), 'declineAppointment'], ['id' => $id]);
})->name("declineAppointment");

Route::get('/appointment-delete/{id}', function($id){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->call([app()->make(AppointmentController::class), 'deleteAppointment'], ['id' => $id]);
})->name("deleteAppointment");

Route::get('/my-appointments', [AppointmentController::class, 'myAppointments'])->name("myAppointments");


// Contact Routes
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contactStore');

Route::get('/dashboard/contact-list', function(){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->make(App\Http\Controllers\ContactController::class)->index();
})->name('contactList');

Route::get('/contact-mark-read/{id}', function($id){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->call([app()->make(App\Http\Controllers\ContactController::class), 'markAsRead'], ['id' => $id]);
})->name('contactMarkAsRead');

Route::get('/contact-mark-replied/{id}', function($id){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->call([app()->make(App\Http\Controllers\ContactController::class), 'markAsReplied'], ['id' => $id]);
})->name('contactMarkAsReplied');

Route::get('/contact-delete/{id}', function($id){
    if(!Auth::check()) return redirect()->route('login');
    if(Auth::user()->email !== ADMIN_EMAIL) return redirect()->route('home');
    return app()->call([app()->make(App\Http\Controllers\ContactController::class), 'delete'], ['id' => $id]);
})->name('contactDelete');

// Subscription Routes 
Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription.index');
Route::post('/subscription/initiate', [SubscriptionController::class, 'initiatePayment'])->name('subscription.initiate');

// Success page route 
Route::get('/subscription/success-page', function() {
    return view('pages.subscription_success');
})->name('subscription.success.page');

// Callback routes without any middleware 
Route::match(['get', 'post'], 'subscription/success', [SubscriptionController::class, 'success'])->name('subscription.success');
Route::match(['get', 'post'], 'subscription/fail', [SubscriptionController::class, 'fail'])->name('subscription.fail');
Route::match(['get', 'post'], 'subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');

// User Profile Routes
Route::get('/profile', [App\Http\Controllers\UserProfileController::class, 'index'])->name('userProfile');
Route::post('/profile/update', [App\Http\Controllers\UserProfileController::class, 'updateProfile'])->name('userProfile.update');
Route::post('/profile/password', [App\Http\Controllers\UserProfileController::class, 'updatePassword'])->name('userProfile.password');
Route::delete('/profile/delete', [App\Http\Controllers\UserProfileController::class, 'deleteAccount'])->name('userProfile.delete');