<style>
.sidebar {
    height: 100vh;
    background-color: #343a40;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 20px;
    width: 240px;
    z-index: 1000;
    overflow-y: auto;
    transition: all 0.3s;
}

.sidebar h4 {
    font-size: 1.5rem;
    font-weight: 600;
    letter-spacing: 1px;
}

.sidebar .nav-link {
    color: #ffffff;
    padding: 12px 20px;
    font-size: 15px;
    display: flex;
    align-items: center;
    transition: background-color 0.3s, padding-left 0.3s;
    border-radius: 0 25px 25px 0;
}

.sidebar .nav-link i {
    font-size: 18px;
    margin-right: 10px;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background-color: #495057;
    padding-left: 25px;
}

.sidebar .dropdown-menu {
    background-color: #495057;
    border: none;
    margin-top: 0;
    border-radius: 0 0 10px 0;
    padding: 0;
}

.sidebar .dropdown-item {
    color: #ffffff;
    padding: 10px 30px;
    font-size: 14px;
    transition: background-color 0.3s, padding-left 0.3s;
}

.sidebar .dropdown-item:hover,
.sidebar .dropdown-item.active {
    background-color: #6c757d;
    padding-left: 35px;
}

.sidebar .nav-item + .nav-item {
    margin-top: 5px;
}

.sidebar form button {
    font-weight: 500;
}

@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding-bottom: 10px;
    }

    .sidebar .nav-link {
        border-radius: 0;
        justify-content: flex-start;
    }

    .sidebar .dropdown-menu {
        position: static;
        float: none;
        display: block;
    }

    .sidebar .nav-item.dropdown > .dropdown-toggle::after {
        display: none;
    }
}
</style>

<div class="sidebar">
    <h4 class="text-white text-center mb-4">Ivory Glow Admin</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.appointments.index') ? 'active' : '' }}" href="{{ route('admin.appointments.index') }}">
                <i class="bi bi-calendar-check"></i>Appointments
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-person-workspace"></i>Staff
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item {{ request()->routeIs('staff.index') ? 'active' : '' }}" href="{{ route('staff.index') }}">Staff List</a></li>
                <li><a class="dropdown-item {{ request()->routeIs('staff.create') ? 'active' : '' }}" href="{{ route('staff.create') }}">Add Staff</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('service.*') ? 'active' : '' }}" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-scissors"></i>Services
            </a>
            <ul class="dropdown-menu {{ request()->routeIs('service.*') ? 'show' : '' }}">
                <li><a class="dropdown-item {{ request()->routeIs('service.index') ? 'active' : '' }}" href="{{ route('service.index') }}">Service List</a></li>
                <li><a class="dropdown-item {{ request()->routeIs('service.create') ? 'active' : '' }}" href="{{ route('service.create') }}">Add Service</a></li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('product.index') ? 'active' : '' }}" href="{{ route('product.index') }}">
                <i class="bi bi-box-seam"></i>Inventory
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                <i class="bi bi-person-lines-fill"></i>Customers
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                <i class="bi bi-bar-chart-line"></i>Reports
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}" href="{{ route('admin.messages') }}">
                <i class="bi bi-envelope"></i>Messages
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.shop-details') ? 'active' : '' }}" href="{{ route('admin.shop-details') }}">
                <i class="bi bi-shop"></i>Shop Details
            </a>
        </li>

        <li class="nav-item mt-3 px-3">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
            </form>
        </li>
    </ul>
</div>
