<li class="nav-item {{ $userNav || $roomNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $userNav || $roomNav ? $active : '' }}">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>
            Master
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route("admin.user.index") }}" class="nav-link @yield("user")">
                <i class="nav-icon fa fa-users iCheck"></i>
                <p>Users</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.room.index')}}" class="nav-link @yield('room')">
                <i class="nav-icon fa fa-dungeon iCheck"></i></i>
                <p>Rooms</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $bookNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $bookNav ? $active : '' }}">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>
            Bookings
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route("admin.booking.index") }}" class="nav-link @yield("booking")">
                <i class="nav-icon fa fa-th-list iCheck"></i>
                <p>All Bookings</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route("admin.booking.create") }}" class="nav-link @yield("add-booking")">
                <i class="nav-icon fa fa-plus iCheck"></i>
                <p>Add Booking</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route("admin.customer.index") }}" class="nav-link @yield("customer")">
        <i class="nav-icon fa fa-users iCheck"></i>
        <p>Customers</p>
    </a>
</li>


