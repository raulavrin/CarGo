<!DOCTYPE html>
<html lang="en">

@include('common.admin.head')

<body class="hold-transition sidebar-mini layout-fixed">
    @include('sweetalert::alert')

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
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
        <aside class="main-sidebar sidebar-light-primary elevation-1" style="background-color: #f8f9fa;">
            <!-- Brand Logo -->
            <a href="/dashboard" class="brand-link bg-white border-bottom">
                <i class="fas fa-car brand-image ml-3 text-primary" style="font-size: 2rem; opacity: .8"></i>
                <span class="brand-text font-weight-bold text-dark">CarGo Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex border-bottom">
                    <div class="image">
                        <i class="fas fa-user-circle fa-2x text-secondary"></i>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-dark font-weight-bold">Admin Panel</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        
                    
                        <li class="nav-header text-uppercase text-muted" style="font-size: 0.75rem; margin-top: 1rem;">Vehicle Management</li>

                        <li class="nav-item">
                            <a href="/dashboard/add-car" class="nav-link">
                                <i class="nav-icon fas fa-plus-circle text-success"></i>
                                <p class="text-dark">Add Vehicle</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/dashboard/car-list" class="nav-link">
                                <i class="nav-icon fas fa-list-alt text-info"></i>
                                <p class="text-dark">Vehicle List</p>
                            </a>
                        </li>

                        <li class="nav-header text-uppercase text-muted" style="font-size: 0.75rem; margin-top: 1rem;">Bookings</li>

                        <li class="nav-item">
                            <a href="/dashboard/appointment-list" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check text-warning"></i>
                                <p class="text-dark">Booking List</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/dashboard/contact-list" class="nav-link">
                                <i class="nav-icon fas fa-envelope"></i>
                                <p class="text-dark">Contact List</p>
                            </a>
                        </li>

                        <li class="nav-header text-uppercase text-muted" style="font-size: 0.75rem; margin-top: 1rem;">System</li>

                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="nav-icon fas fa-external-link-alt text-secondary"></i>
                                <p class="text-dark">Visit Live Site</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{route('logout')}}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                <p class="text-dark">Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper" style="background-color: #f4f6f9;">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid pt-4">
                    @yield("main_content")
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer bg-white border-top">
            <strong>Copyright &copy; 2025 <a href="/" class="text-primary">CarGo</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Admin Panel</b> v1.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    @include('common.admin.script')

    <style>
        /* Custom styles for ash and white theme */
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