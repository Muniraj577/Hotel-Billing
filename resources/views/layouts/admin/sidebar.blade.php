<?php
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
$menu = 'menu-open';
$active = 'active menu-open';
$bookNav = Request::is('admin/booking*');
$userNav  = Request::is('admin/user*');
$roomTypeNav = Request::is('admin/room-type*');
$roomNav = Request::is('admin/room*');
$productNav = Request::is('admin/product*');
$unitNav = Request::is('admin/unit*');
$orderNav = Request::is('admin/order*');
$identityNav = Request::is('admin/identity*');

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('admin.dashboard')}}" class="brand-link">
               <img src="{{asset('images/admin/avatars/default.png')}}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ getUser()->avatarImg(getUser()->avatar) }}" class="img-circle elevation-2"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ getUser()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link @yield('dashboard')">
                        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @include('layouts.admin.sidebar.allnav')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
