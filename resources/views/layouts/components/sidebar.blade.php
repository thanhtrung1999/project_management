<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @php
        $role = getLoginRole();
    @endphp
    <a href="{{ route("{$role}.dashboard") }}" class="brand-link">
        <img src="{{ asset('images/logo-hvktmm.png') }}" alt="KMA Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">KMA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div> --}}
            <div class="info w-100 text-center">
                <a href="#" class="d-block">{{ getAccountInfo()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @php
                    $role= getLoginRole();
                @endphp
                <li class="nav-item">
                    <a href="{{ route("{$role}.dashboard") }}" class="nav-link @yield('active-dashboard')">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (getLoginRole() == 'admin')
                <li class="nav-item">
                    <a href="{{ route('accounts.index') }}" class="nav-link @yield('active-admin')">
                        <i class="nav-icon fa-users"></i>
                        <p>
                            Quản lý tài khoản
                        </p>
                    </a>
                </li>
                @endif
                @if (getLoginRole() == 'teacher')
                <li class="nav-item">
                    <a href="{{ route('teacher.projects.index') }}" class="nav-link @yield('active-teacher')">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Quản lý bài tập lớn của sinh viên
                        </p>
                    </a>
                </li>
                @endif
                @if (getLoginRole() == 'student')
                <li class="nav-item">
                    <a href="{{ route('student.projects.index') }}" class="nav-link @yield('active-student')">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Quản lý bài tập lớn
                        </p>
                    </a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
