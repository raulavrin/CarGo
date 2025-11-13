<!-- Navbar Start -->
<div class="container-fluid nav-bar bg-transparent">
    <nav class="navbar navbar-expand-lg navbar-light py-3 px-4">
        <div class="container-fluid">
            <!-- Logo -->
            <a href="/" class="navbar-brand d-flex align-items-center">
                <div class="icon p-2 me-2 bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                    <i class="fas fa-car text-white"></i>
                </div>
                <h1 class="m-0 fw-bold" style="font-size: 1.75rem;">Car<span class="text-primary">Go</span></h1>
            </a>

            <!-- Mobile Toggle -->
            <button type="button" class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <!-- Center Nav Links -->
                <div class="navbar-nav mx-auto">
                    <a href="/" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="/about" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">About</a>
                    @if(Auth::user())
                        <a href="/my-appointments" class="nav-item nav-link {{ request()->is('my-appointments') ? 'active' : '' }}">My Bookings</a>
                    @endif
                    <a href="/contact" class="nav-item nav-link {{ request()->is('contact') ? 'active' : '' }}">Contact</a>
                </div>

               <!-- Right Side Actions -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Theme Toggle -->
                    <button class="theme-toggle-modern" id="themeToggle" aria-label="Toggle theme" title="Toggle theme">
                        <i class="fas fa-moon theme-icon" id="themeIcon"></i>
                    </button>

                    <!-- Auth Actions -->
                    @if(Auth::user())
                        <!-- Profile/Dashboard Button -->
                        @if(Auth::user()->email === ADMIN_EMAIL)
                            <a href="{{route('carList')}}" class="btn btn-outline-primary rounded-pill px-4 py-2" title="Go to Dashboard">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        @else
                            <a href="{{route('userProfile')}}" class="btn btn-outline-primary rounded-pill px-4 py-2" title="View Profile">
                                <i class="fas fa-user me-2"></i>Profile
                            </a>
                        @endif
                        
                        <!-- Logout Button -->
                        <a href="{{route('logout')}}" class="btn btn-outline-danger rounded-pill px-4 py-2">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    @else
                        <a href="/login" class="btn btn-primary rounded-pill px-4 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i>Login
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
<!-- Navbar End -->