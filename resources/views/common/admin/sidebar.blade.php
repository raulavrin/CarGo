<div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Raul Jobel Baroi</a>
        </div>
      </div>

      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="/" class="nav-link">
              <i class="fas fa-home"></i>
              <p>
                Live Site
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/add-car" class="nav-link">
              <i class="fas fa-plus"></i>
              <p>
                Add Vehicle
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/car-list" class="nav-link">
              <i class="fas fa-car"></i>
              <p>
                Vehicle List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/appointment-list" class="nav-link">
              <i class="fas fa-calendar-check"></i>
              <p>
                Booking List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('contactList') }}" class="nav-link">
              <i class="fas fa-envelope"></i>
              <p>
                Contact Messages
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route("logout")}}" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>