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
        font-family: 'Playfair Display', serif;
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

    .sidebar .nav-item + .nav-item {
        margin-top: 5px;
    }

    .sidebar .btn {
        border-radius: 25px;
        font-weight: 600;
        background: #ffffff;
        color: #343a40;
        border: none;
        margin: 10px 0;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .sidebar .btn:hover {
        background: #6c757d;
        color: #ffffff;
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
            padding-bottom: 10px;
        }

        .sidebar .nav {
            flex-direction: row;
            justify-content: center;
            gap: 10px;
        }

        .sidebar .nav-link {
            border-radius: 10px;
            margin: 5px;
            padding: 8px 15px;
            font-size: 0.9rem;
        }

        .sidebar .btn {
            width: 100%;
        }
    }
</style>

<div class="sidebar">
    <h4 class="text-white text-center mb-4">Ivory Glow Staff</h4>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('staff.dashboard') }}" class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('staff.appointments') }}" class="nav-link {{ request()->routeIs('staff.appointments') ? 'active' : '' }}">
                <i class="bi bi-calendar-check me-2"></i>Appointment Management
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('staff.customers') }}" class="nav-link {{ request()->routeIs('staff.customers') ? 'active' : '' }}">
                <i class="bi bi-person-lines-fill me-2"></i>Customer Interaction
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('staff.profile') }}" class="nav-link {{ request()->routeIs('staff.profile') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-2"></i>Profile
            </a>
        </li>
        <li class="nav-item mt-3 px-3">
            <form method="POST" action="{{ route('staff.logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </button>
            </form>
        </li>
    </ul>
</div>
