@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
{{-- @dd($prefix) --}}
{{-- @dd($route) --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('public/backend') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ !empty(Auth::user()->image) ? url('public/upload/profile_images/' . Auth::user()->image) : url('public/upload/avater_1.png') }}"
                    style="width: 40px; height: 40px; border-redius: 50%" class="img-circle elevation-2">
            </div>
            <div class="info">
                <a href="{{ route('profile.view') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview @yield('manage-user')">
                    <a href="#" class="nav-link @yield('manage-user')">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('user.view') }}" class="nav-link @yield('view-user')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item has-treeview @yield('manage-profile')">
                    <a href="#" class="nav-link @yield('manage-profile')">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Manage Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile.view') }}" class="nav-link @yield('view-profile')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Profile</p>
                            </a>
                            <a href="{{ route('change.password') }}" class="nav-link @yield('change-password')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>

                    </ul>
                </li> --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/profiles' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Profile Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile.view') }}"
                                class="nav-link {{ $route == 'profile.view' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Profile</p>
                            </a>
                            <a href="{{ route('change.password') }}"
                                class="nav-link {{ $route == 'change.password' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview {{ $prefix == 'admin/setup/student' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Setup Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('setup.student.class.view') }}"
                                class="nav-link {{ $route == 'setup.student.class.view' || $route == 'setup.student.class.create' || $route == 'setup.student.class.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student Class</p>
                            </a>
                            <a href="{{ route('setup.student.year.view') }}"
                                class="nav-link {{ $route == 'setup.student.year.view' || $route == 'setup.student.year.create' || $route == 'setup.student.year.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Year</p>
                            </a>
                            <a href="{{ route('setup.student.group.view') }}"
                                class="nav-link {{ $route == 'setup.student.group.view' || $route == 'setup.student.group.create' || $route == 'setup.student.group.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student Group</p>
                            </a>
                            <a href="{{ route('setup.student.shift.view') }}"
                                class="nav-link {{ $route == 'setup.student.shift.view' || $route == 'setup.student.shift.create' || $route == 'setup.student.shift.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student Shift</p>
                            </a>
                            <a href="{{ route('setup.student.free.category.view') }}"
                                class="nav-link {{ $route == 'setup.student.free.category.view' || $route == 'setup.student.free.category.create' || $route == 'setup.student.free.category.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Free Category</p>
                            </a>
                            <a href="{{ route('setup.student.free.amount.view') }}"
                                class="nav-link {{ $route == 'setup.student.free.amount.view' || $route == 'setup.student.free.amount.create' || $route == 'setup.student.free.amount.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Free Category Amount</p>
                            </a>
                            <a href="{{ route('setup.student.examtype.view') }}"
                                class="nav-link {{ $route == 'setup.student.examtype.view' || $route == 'setup.student.examtype.create' || $route == 'setup.student.examtype.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Type</p>
                            </a>
                            <a href="{{ route('setup.subject.view') }}"
                                class="nav-link {{ $route == 'setup.subject.view' || $route == 'setup.subject.create' || $route == 'setup.subject.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subject</p>
                            </a>
                            <a href="{{ route('setup.assignsubject.view') }}"
                                class="nav-link {{ $route == 'setup.assignsubject.view' || $route == 'setup.assignsubject.create' || $route == 'setup.assignsubject.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Assign Subject</p>
                            </a>
                            <a href="{{ route('setup.designation.view') }}"
                                class="nav-link {{ $route == 'setup.designation.view' || $route == 'setup.designation.create' || $route == 'setup.designation.edit' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Designation</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- student --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/students' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Students Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('students.registration.view') }}" class="nav-link {{ ( ($route == 'students.registration.view') || ($route == 'students.registration.create') || ($route == 'students.registration.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Students Registration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.roll.view') }}" class="nav-link {{ ( ($route == 'student.roll.view') || ($route == 'students.roll.get-student') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roll Generate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('student.reg.fee.view') }}" class="nav-link {{ ( ($route == 'student.reg.fee.view') || ($route == 'student.reg.fee.get-student') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registration Fee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students.monthly.fee.view') }}" class="nav-link {{ ( ($route == 'students.monthly.fee.view') || ($route == 'students.monthly.fee.get-student') || ($route == 'students.monthly.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Monthly Fee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students.exam.fee.view') }}" class="nav-link {{ ( ($route == 'students.exam.fee.view') || ($route == 'students.exam.fee.get-student') || ($route == 'students.exam.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exam Fee</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- employee --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/employees' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Employee Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('employees.registration.view') }}" class="nav-link {{ ( ($route == 'employees.registration.view') || ($route == 'employees.registration.create') || ($route == 'employees.registration.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Registration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employees.salary.view') }}" class="nav-link {{ ( ($route == 'employees.salary.view') || ($route == 'employees.salary.create') || ($route == 'employees.salary.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Salary</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employees.leave.view') }}" class="nav-link {{ ( ($route == 'employees.leave.view') || ($route == 'employees.leave.create') || ($route == 'employees.leave.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Leave</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employees.attendance.view') }}" class="nav-link {{ ( ($route == 'employees.attendance.view') || ($route == 'employees.attendance.create') || ($route == 'employees.attendance.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Attendace</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employees.monthly.salary.view') }}" class="nav-link {{ ( ($route == 'employees.monthly.salary.view') || ($route == 'employees.monthly.salary.get') || ($route == 'employees.monthly.salary.payslip') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Monthly Salary</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- employee --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/marks' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Marks Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('marks.create') }}" class="nav-link {{ ( ($route == 'marks.create') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Marks Entry</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('marks.edit') }}" class="nav-link {{ ( ($route == 'marks.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Marks Edit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('marks.grade.view') }}" class="nav-link {{ ( ($route == 'marks.grade.view') || ($route == 'marks.grade.create') || ($route == 'marks.grade.edit') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grade Point</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Accounts --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/accounts' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Accounts Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('accounts.student.fee.view') }}" class="nav-link {{ ( ($route == 'accounts.student.fee.view') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Student Fee</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('accounts.employee.salary.view') }}" class="nav-link {{ ( ($route == 'accounts.employee.salary.view') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employee Salary</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('accounts.cost.view') }}" class="nav-link {{ ( ($route == 'accounts.cost.view') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Others Cost</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Report --}}
                <li class="nav-item has-treeview {{ $prefix == 'admin/reports' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Report Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('roports.profit.view') }}" class="nav-link {{ ( ($route == 'roports.profit.view') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Monthly Profit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roports.marksheet.view') }}" class="nav-link {{ ( ($route == 'roports.marksheet.view') ) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Marksheet</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
