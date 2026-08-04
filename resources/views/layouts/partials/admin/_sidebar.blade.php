<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button">
            <i class="zmdi zmdi-menu"></i>
        </button>
        <a href="/" target="_blank"><span class="m-l-10"> Property Portal</span></a>
    </div>

    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
<a class="image" href="{{ route('admin.profile') }}">
    <img src="/Smart/Admin/assets/images/avatar.jpg" alt="User" />
</a>

                    <div class="detail">
                        <h4>{{ Auth::user()->name }}</h4>
                        <small>{{ Auth::user()->getRoleNames()->first() ?? 'N/A' }}</small>
                    </div>
                </div>
            </li>

            {{-- Dashboard --}}
            <li class="{{ 'admin/dashboard' == request()->path() ? 'active' : '' }} open">
                <a href="{{ route('admin.dashboard') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a>
            </li>

<li class="{{ Request::is('admin/cars*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-car"></i><span>Cars</span></a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.cars.index') }}">All Cars</a></li>
        <li><a href="{{ route('admin.cars.pending') }}">Pending Approval</a></li>
        <li><a href="{{ route('admin.cars.approved') }}">Approved Cars</a></li>
        <li><a href="{{ route('admin.cars.rejected') }}">Rejected Cars</a></li>
    </ul>
</li>


{{-- House Management --}}
<li class="{{ Request::is('admin/houses*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-home"></i><span>Houses</span></a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.houses.index') }}">All Houses</a></li>
        <li><a href="{{ route('admin.houses.pending') }}">Pending Approval</a></li>
        <li><a href="{{ route('admin.houses.approved') }}">Approved Houses</a></li>
        <li><a href="{{ route('admin.houses.rejected') }}">Rejected Houses</a></li>
    </ul>
</li>

{{-- User Management --}}
<li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
    <a href="javascript:void(0);" class="menu-toggle">
        <i class="zmdi zmdi-account"></i><span>Users</span>
    </a>
    <ul class="ml-menu">
        <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
        <li><a href="{{ route('admin.users.owners') }}">Property Owners</a></li>
        <li><a href="#">Buyers/Renters</a></li>
    </ul>
</li>

            {{-- Settings --}}
            <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                <ul class="ml-menu">
                    <li><a href="#">General Settings</a></li>
                    <li><a href="#">Email Settings</a></li>
                    <li><a href="#">Payment Settings</a></li>
                </ul>
            </li>

{{-- Role Management --}}
<li class="{{ Request::is('admin/roles*') ? 'active' : '' }}">
    <a href="{{ route('admin.roles.index') }}">
        <i class="zmdi zmdi-shield-security"></i>
        <span>Role Management</span>
    </a>
</li>

{{-- Messages --}}
<li class="{{ request()->is('admin/messages*') ? 'active' : '' }}">
    <a href="{{ route('admin.messages.index') }}">
        <i class="zmdi zmdi-email"></i>
        <span>Messages</span>
    </a>
</li>


{{-- Profile --}}
<li class="{{ request()->is('admin/profile*') ? 'active' : '' }}">
    <a href="{{ route('admin.profile') }}">
        <i class="zmdi zmdi-account-circle"></i>
        <span>Profile</span>
    </a>
</li>

        </ul>
    </div>
</aside>
