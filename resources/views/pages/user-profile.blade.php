<!DOCTYPE html>
<html lang="en">

@include('common.site.head')

<body class="bg-light">
    <div class="container-xxl p-0 bg-light">
        <!-- Spinner Start -->
        <div id="spinner" class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center bg-light">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar Start -->
        @include('common.site.navbar')
        <!-- Navbar End -->

        @include('sweetalert::alert')

        <!-- Profile Content Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <!-- Profile Header -->
                        <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                            <h1 class="mb-3 section-title">My Profile</h1>
                            <p class="section-subtitle">Manage your account information and preferences</p>
                        </div>

                        <div class="row g-4">
                            <!-- Profile Information Card -->
                            <div class="col-lg-6">
                                <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                            <i class="fas fa-user fa-2x text-white"></i>
                                        </div>
                                        <div>
                                            <h4 class="mb-1">{{ $user->name }}</h4>
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>

                                    <form action="{{ route('userProfile.update') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Full Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Address</label>
                                            <textarea name="address" class="form-control" rows="3" required>{{ old('address', $user->address) }}</textarea>
                                            @error('address')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill">
                                            <i class="fas fa-save me-2"></i>Update Profile
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Change Password Card -->
                            <div class="col-lg-6">
                                <div class="bg-white rounded-4 p-4 shadow-sm h-100">
                                    <div class="mb-4">
                                        <h4 class="mb-2"><i class="fas fa-lock text-primary me-2"></i>Change Password</h4>
                                        <p class="text-muted mb-0">Update your password to keep your account secure</p>
                                    </div>

                                    <form action="{{ route('userProfile.password') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Current Password</label>
                                            <input type="password" name="current_password" class="form-control" required>
                                            @error('current_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">New Password</label>
                                            <input type="password" name="new_password" class="form-control" required>
                                            @error('new_password')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <small class="text-muted">Minimum 6 characters</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Confirm New Password</label>
                                            <input type="password" name="new_password_confirmation" class="form-control" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill">
                                            <i class="fas fa-key me-2"></i>Change Password
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Quick Actions Card -->
                            <div class="col-12">
                                <div class="bg-white rounded-4 p-4 shadow-sm">
                                    <h4 class="mb-4"><i class="fas fa-th-large text-primary me-2"></i>Quick Actions</h4>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <a href="{{ route('home') }}" class="btn w-100 py-3 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">
                                                <i class="fas fa-car me-2"></i>Browse Vehicles
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('myAppointments') }}" class="btn w-100 py-3 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">
                                                <i class="fas fa-calendar-check me-2"></i>My Bookings
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('subscription.index') }}" class="btn w-100 py-3 rounded-pill" style="border:1px solid #d9d9d9;color:#333;background:#f7f7f7;">
                                                <i class="fas fa-crown me-2"></i>Subscriptions
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-lg-square back-to-top back-to-top-new rounded-circle"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('common.site.script')
</body>

</html>