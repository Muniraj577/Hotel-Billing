<li class="nav-item {{ $userNav || $roomNav || $productNav || $unitNav || $roomTypeNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $userNav || $roomNav || $productNav || $unitNav || $roomTypeNav ? $active : '' }}">
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
            <a href="{{route('admin.room_type.index')}}" class="nav-link @yield('room-type')">
                <i class="nav-icon fa fa-dungeon iCheck"></i></i>
                <p>Room Type</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.room.index')}}" class="nav-link @yield('room')">
                <i class="nav-icon fa fa-dungeon iCheck"></i></i>
                <p>Rooms</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.unit.index')}}" class="nav-link @yield('unit')">
                <i class="nav-icon fab fa-product-hunt iCheck"></i></i>
                <p>Units</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.product.index')}}" class="nav-link @yield('product')">
                <i class="nav-icon fab fa-product-hunt iCheck"></i></i>
                <p>Products</p>
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
<li class="nav-item {{ $orderNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $orderNav ? $active : '' }}">
        <i class="nav-icon fa fa-th-list iCheck"></i>
        <p>
            Orders
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route("admin.order.index") }}" class="nav-link @yield("order")">
                <i class="nav-icon fa fa-th-list iCheck"></i>
                <p>All Orders</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route("admin.order.create") }}" class="nav-link @yield("add-order")">
                <i class="nav-icon fa fa-plus iCheck"></i>
                <p>Add Order</p>
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


