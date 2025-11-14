<!DOCTYPE html>
<html lang="en">

@include('common.admin.head')

<style>
    /* Dark Theme Variables */
    :root {
        --admin-bg: #f4f6f9;
        --admin-sidebar-bg: #f8f9fa;
        --admin-card-bg: #ffffff;
        --admin-text: #333;
        --admin-text-muted: #6c757d;
        --admin-border: #dee2e6;
        --admin-navbar-bg: #ffffff;
    }

    [data-theme="dark"] {
        --admin-bg: #1a202c;
        --admin-sidebar-bg: #2d3748;
        --admin-card-bg: #2d3748;
        --admin-text: #e2e8f0;
        --admin-text-muted: #a0aec0;
        --admin-border: #4a5568;
        --admin-navbar-bg: #2d3748;
    }

    [data-theme="dark"] body {
        background-color: var(--admin-bg) !important;
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .content-wrapper {
        background-color: var(--admin-bg) !important;
    }

    [data-theme="dark"] .main-sidebar {
        background-color: var(--admin-sidebar-bg) !important;
    }

    [data-theme="dark"] .brand-link {
        background-color: var(--admin-navbar-bg) !important;
        border-bottom: 1px solid var(--admin-border) !important;
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .main-header {
        background-color: var(--admin-navbar-bg) !important;
        border-bottom: 1px solid var(--admin-border) !important;
    }

    [data-theme="dark"] .navbar-light .navbar-nav .nav-link {
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .nav-sidebar .nav-link {
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .nav-sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
    }

    [data-theme="dark"] .nav-header {
        color: var(--admin-text-muted) !important;
    }

    [data-theme="dark"] .card {
        background-color: var(--admin-card-bg) !important;
        border-color: var(--admin-border) !important;
    }

    [data-theme="dark"] .card-header {
        background-color: rgba(0, 0, 0, 0.1) !important;
        border-bottom: 1px solid var(--admin-border) !important;
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .card-title {
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .table {
        color: var(--admin-text) !important;
        background-color: var(--admin-card-bg) !important;
    }

    [data-theme="dark"] .table thead th {
        border-color: var(--admin-border) !important;
        background-color: rgba(0, 0, 0, 0.2) !important;
    }

    [data-theme="dark"] .table td {
        border-color: var(--admin-border) !important;
    }

    [data-theme="dark"] .table-hover tbody tr:hover {
        background-color: rgba(215, 215, 215, 0.82) !important;
    }

    [data-theme="dark"] .form-control {
        background-color: var(--admin-bg) !important;
        border-color: var(--admin-border) !important;
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .form-control:focus {
        background-color: var(--admin-bg) !important;
        border-color: #007bff !important;
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .custom-file-label {
        background-color: var(--admin-bg) !important;
        border-color: var(--admin-border) !important;
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .custom-file-label::after {
        background-color: rgba(0, 0, 0, 0.2) !important;
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .user-panel {
        border-bottom: 1px solid var(--admin-border) !important;
    }

    [data-theme="dark"] .user-panel .info a {
        color: var(--admin-text) !important;
    }

    [data-theme="dark"] .small-box {
        box-shadow: 0 0 1px rgba(255, 255, 255, 0.1), 0 1px 3px rgba(255, 255, 255, 0.05) !important;
    }

    /* Theme Toggle Button */
    .theme-toggle-admin {
        background: transparent;
        border: none;
        color: var(--admin-text);
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .theme-toggle-admin:hover {
        color: #007bff;
        transform: scale(1.1);
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('sweetalert::alert')

    <script>
        // Initialize theme immediately
        (function() {
            const storedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', storedTheme);
        })();
    </script>

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/" class="nav-link">
                        <i class="fas fa-globe mr-1"></i> View Site
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="nav-link theme-toggle-admin" id="adminThemeToggle" title="Toggle Theme">
                        <i class="fas fa-moon" id="adminThemeIcon"></i>
                    </button>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-1">
            <!-- Brand Logo -->
            <a href="/dashboard/car-list" class="brand-link">
                <i class="fas fa-car brand-image ml-3 text-primary" style="font-size: 2rem; opacity: .8"></i>
                <span class="brand-text font-weight-bold">CarGo Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <i class="fas fa-user-circle fa-2x text-secondary"></i>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block font-weight-bold">Admin Panel</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        
                        <li class="nav-header text-uppercase" style="font-size: 0.75rem; margin-top: 1rem;">Vehicle Management</li>

                        <li class="nav-item">
                            <a href="/dashboard/add-car" class="nav-link">
                                <i class="nav-icon fas fa-plus-circle text-success"></i>
                                <p>Add Vehicle</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/dashboard/car-list" class="nav-link">
                                <i class="nav-icon fas fa-list-alt text-info"></i>
                                <p>Vehicle List</p>
                            </a>
                        </li>

                        <li class="nav-header text-uppercase" style="font-size: 0.75rem; margin-top: 1rem;">Bookings</li>

                        <li class="nav-item">
                            <a href="/dashboard/appointment-list" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check text-warning"></i>
                                <p>Booking List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/dashboard/contact-list" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p>Contact List</p>
                            </a>
                        </li>

                        <li class="nav-header text-uppercase" style="font-size: 0.75rem; margin-top: 1rem;">System</li>

                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-external-link-alt text-secondary"></i>
                                <p>Visit Live Site</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pt-4">
                    @yield("main_content")
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->

    @include('common.admin.script')

    <script>
        // Theme Toggle for Admin Panel
        const initAdminTheme = () => {
            const storedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', storedTheme);
            updateAdminThemeIcon(storedTheme);
        };

        const updateAdminThemeIcon = (theme) => {
            const icon = document.getElementById('adminThemeIcon');
            if (icon) {
                if (theme === 'dark') {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            }
        };

        const toggleAdminTheme = () => {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateAdminThemeIcon(newTheme);
        };

        // Initialize on page load
        initAdminTheme();

        // Attach event listener
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('adminThemeToggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleAdminTheme);
            }
        });
    </script>

    <style>
        /* Additional styles */
        .main-sidebar {
            box-shadow: 2px 0 6px rgba(0,0,0,0.05);
        }
        
        .nav-sidebar .nav-link {
            border-radius: 0.25rem;
            margin: 0.1rem 0.5rem;
        }
        
        .nav-sidebar .nav-link:hover {
            background-color: #e9ecef;
        }
        
        .nav-sidebar .nav-link.active {
            background-color: #e7f3ff;
            color: #007bff !important;
        }
        
        .nav-sidebar .nav-link.active i {
            color: #007bff !important;
        }
        
        .brand-link {
            border-bottom: 1px solid #dee2e6;
        }
        
        .content-wrapper {
            min-height: calc(100vh - 3.5rem - 3.5rem);
        }
        
        .main-header {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .nav-header {
            padding: 0.5rem 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
    </style>
</body>

</html>