<li class="nav-item">
    <a href="{{route('admin.room.index')}}" class="nav-link @yield('room')">
        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
        <p>Rooms</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route("admin.booking.index") }}" class="nav-link @yield("booking")">
        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
        <p>All Bookings</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route("admin.booking.create") }}" class="nav-link @yield("add-booking")">
        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
        <p>Add Booking</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route("admin.customer.index") }}" class="nav-link @yield("customer")">
        <i class="nav-icon fas fa-tachometer-alt iCheck"></i>
        <p>Customers</p>
    </a>
</li>
{{-- <li class="nav-item">
    <a href="#" class="nav-link {{ $catNav || $brandNav || $unitNav || $warehousenav || $branchNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-user iCheck"></i>
        <p>
            Master
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.category.index') }}" class="nav-link @yield('category')">
                <i class="nav-icon fas fa-folder-open iCheck"></i>
                <p>Categories</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.subcategory.index') }}" class="nav-link @yield('subcategory')">
                <i class="nav-icon fas fa-folder-open iCheck"></i>
                <p>Sub Categories</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.branch.index') }}" class="nav-link @yield('branch')">
                <i class="nav-icon fas fa-folder-open iCheck"></i>
                <p>Branches</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.brand.index') }}" class="nav-link @yield('brand')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Brand</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.unit.index') }}" class="nav-link @yield('unit')">
                <i class="nav-icon fas fa-wrench iCheck"></i>
                <p>Unit</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.warehouse.index') }}" class="nav-link @yield('warehouse')">
                <i class="nav-icon fas fa-store iCheck"></i>
                <p>WareHouse</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.fiscal.index') }}" class="nav-link @yield('fiscal')">
                <i class="nav-icon fas fa-calendar iCheck"></i>
                <p>Fiscal</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $adminNav || $userNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $adminNav || $userNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-users iCheck"></i>
        <p>
            User Management
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.admins.create') }}" class="nav-link @yield('add_admin')">
                <i class="nav-icon fas fa-user-plus iCheck"></i>
                <p>Add Admin</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.admins.index') }}" class="nav-link @yield('admin_user')">
                <i class="nav-icon fas fa-users iCheck"></i>
                <p>List Admins</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.create') }}" class="nav-link @yield('add_user')">
                <i class="nav-icon fas fa-user-plus iCheck"></i>
                <p>Add Branch User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.user.index') }}" class="nav-link @yield('user')">
                <i class="nav-icon fas fa-users iCheck"></i>
                <p>List Branch Users</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $supplier ? $menu : '' }}">
    <a href="#" class="nav-link {{ $supplier ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-users iCheck"></i>
        <p>
            Supplier
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.supplier.create') }}" class="nav-link @yield('add-supplier')">
                <i class="nav-icon fas fa-user-plus iCheck"></i>
                <p>Add Supplier</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.supplier.index') }}" class="nav-link @yield('supplier')">
                <i class="nav-icon fas fa-users iCheck"></i>
                <p>List Suppliers</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $customerNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $customerNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-users iCheck"></i>
        <p>
            Customer
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.customer.create') }}" class="nav-link @yield('add-customer')">
                <i class="nav-icon fas fa-user-plus iCheck"></i>
                <p>Add Customer</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.customer.index') }}" class="nav-link @yield('customer')">
                <i class="nav-icon fas fa-users iCheck"></i>
                <p>List Customers</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $productNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $productNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fab fa-product-hunt iCheck"></i>
        <p>
            Product
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.product.create') }}" class="nav-link @yield('add-product')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Add Product</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.product.index') }}" class="nav-link @yield('product')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>All Products</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $purchaseNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $purchaseNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fas fa-shopping-cart iCheck"></i>
        <p>
            Purchases
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.purchase.create') }}" class="nav-link @yield('add-purchase')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Add Purchase</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.purchase.index') }}" class="nav-link @yield('purchase')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>List Purchases</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.purchase.return.create') }}" class="nav-link @yield('add-purchase-return')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>New Purchase Return</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.purchase.return.index') }}" class="nav-link @yield('purchase-return')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>All Purchase Returns</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.purchase.payment.create') }}" class="nav-link @yield('add-purchase-payment')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Create Purchase Payment</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.purchase.payment.index') }}" class="nav-link @yield('purchase-payment')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>All Payments</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.purchase.ledger.index') }}" class="nav-link @yield('purchase-ledger')">
                <i class="nav-icon fa fa-eye iCheck"></i>
                <p>Ledger</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item {{ $saleNav || $saleReturnNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $saleNav || $saleReturnNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fa fa-cart-arrow-down iCheck"></i>
        <p>
            Sales
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.sale.create') }}" class="nav-link @yield('add-sale')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Add Sale</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sale.index') }}" class="nav-link @yield('sale')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>List Sales</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sale.return.create') }}" class="nav-link @yield('add_sale_return')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>New Sales Return</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sale.return.index') }}" class="nav-link @yield('sale-return')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Sales Returns</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sale.payment.create') }}" class="nav-link @yield('add-sale-payment')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Create Sale Payment</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sale.payment.index') }}" class="nav-link @yield('sale-payment')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>All Payments</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sale.ledger.index') }}" class="nav-link @yield('sale-ledger')">
                <i class="nav-icon fa fa-eye iCheck"></i>
                <p>Ledger</p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ route('admin.return.return_products') }}" class="nav-link @yield('sale_product_return')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Return Products</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.return.dispatch_products') }}" class="nav-link @yield('sale_product_dispatch')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Dispatch Products</p>
            </a>
        </li> --}}
    {{-- </ul>
</li>
<li class="nav-item {{ $posNav ? $menu : '' }}">
    <a href="#" class="nav-link {{ $posNav ? 'active menu-open' : '' }}">
        <i class="nav-icon fa fa-cart-arrow-down iCheck"></i>
        <p>
            POS
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.pos.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>Add POS Sales</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pos.index') }}" class="nav-link @yield('pos_sale')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Pos Sales</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pos.return.create') }}" class="nav-link @yield('add_pos_return')">
                <i class="nav-icon fas fa-plus iCheck"></i>
                <p>New Pos Return</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pos.return.index') }}" class="nav-link @yield('pos-return')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Pos Returns</p>
            </a>
        </li> --}}
        {{-- <li class="nav-item">
            <a href="{{ route('admin.pos.return.return_sales') }}" class="nav-link @yield('pos_return')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Pos Returns</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pos.return.return_products') }}" class="nav-link @yield('pos_product_return')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Return Products</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.pos.return.dispatch_products') }}"
                class="nav-link @yield('pos_product_dispatch')">
                <i class="nav-icon fas fa-th-list iCheck"></i>
                <p>Dispatch Products</p>
            </a>
        </li> --}}
    {{-- </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fa fa-home iCheck"></i>
        <p>
            General Settings
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.general.index') }}" class="nav-link @yield('general-setting')">
                <i class="nav-icon fa fa-building iCheck"></i>
                <p>Company Information</p>
            </a>
        </li>
    </ul>
</li> --}}

