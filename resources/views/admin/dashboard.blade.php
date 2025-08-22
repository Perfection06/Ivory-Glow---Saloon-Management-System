<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Existing styles unchanged */
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f0f4f8, #d9e2ec);
            color: #2c3e50;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .main-content {
            margin-left: 240px;
            padding: 30px 20px;
            transition: margin-left 0.3s;
        }

        .section {
            padding: 30px 0;
        }

        .dashboard-header {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 30px 25px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .dashboard-header h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .card-widget {
            background: #ffffff;
            border: 1px solid #e3e6ea;
            border-radius: 16px;
            padding: 25px 20px;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }

        .card-widget:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .card-widget i {
            font-size: 2rem;
            color: #1abc9c;
            margin-bottom: 12px;
        }

        .card-widget h5 {
            margin-bottom: 5px;
            font-size: 1rem;
            font-weight: 600;
        }

        .card-widget h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            font-weight: 700;
        }

        .progress {
            height: 30px;
            border-radius: 30px;
            overflow: hidden;
            font-size: 0.875rem;
        }

        .progress-bar-custom {
            background-color: #1abc9c;
        }

        .low-stock-list {
            max-height: 250px;
            overflow-y: auto;
        }

        .settings-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #e67e22;
            color: #fff;
            border: none;
            z-index: 1050;
        }

        .settings-btn:hover {
            background: #d35400;
        }

        footer {
            background-color: #2c3e50;
        }

        .list-group-item {
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px 10px;
            }
            .settings-btn {
                top: auto;
                bottom: 20px;
            }
            .card-widget {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="container-fluid">
                <div class="dashboard-header text-center">
                    <h2>Admin Dashboard</h2>
                    <p class="text-muted">Overview of salon operations</p>
                </div>

                <a href="{{ route('admin.settings') }}" class="btn settings-btn">
                    <i class="bi bi-gear-fill me-1"></i>My Settings
                </a>

                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="card card-widget">
                            <i class="bi bi-people"></i>
                            <h5>Total Customers</h5>
                            <h3>{{ $totalCustomers }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-widget">
                            <i class="bi bi-person-workspace"></i>
                            <h5>Total Staff</h5>
                            <h3>{{ $totalStaff }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-widget">
                            <i class="bi bi-cash"></i>
                            <h5>Income (This Month)</h5>
                            <h3>Rs.{{ number_format($income, 2) }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row g-4 mt-4">
                    <div class="col-md-3">
                        <div class="card card-widget">
                            <i class="bi bi-check-circle"></i>
                            <h5>Completed</h5>
                            <h3>{{ $completedAppointments }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-widget">
                            <i class="bi bi-clock"></i>
                            <h5>Pending</h5>
                            <h3>{{ $pendingAppointments }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-widget">
                            <i class="bi bi-check"></i>
                            <h5>Accepted</h5>
                            <h3>{{ $acceptedAppointments }}</h3>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-widget">
                            <i class="bi bi-x-circle"></i>
                            <h5>Cancelled</h5>
                            <h3>{{ $cancelledAppointments }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-widget p-4">
                            <h5>Appointment Status Overview</h5>
                            @php
                                $totalAppointments = $completedAppointments + $pendingAppointments + $acceptedAppointments + $cancelledAppointments;
                            @endphp
                            @if ($totalAppointments > 0)
                                <div class="progress mt-3">
                                    <div class="progress-bar progress-bar-custom" role="progressbar" style="width: {{ ($completedAppointments / $totalAppointments) * 100 }}%">{{ $completedAppointments }} Completed</div>
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ ($pendingAppointments / $totalAppointments) * 100 }}%">{{ $pendingAppointments }} Pending</div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ ($acceptedAppointments / $totalAppointments) * 100 }}%">{{ $acceptedAppointments }} Accepted</div>
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: {{ ($cancelledAppointments / $totalAppointments) * 100 }}%">{{ $cancelledAppointments }} Cancelled</div>
                                </div>
                            @else
                                <p class="text-muted mt-3">No appointments available to display.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-widget p-4">
                            <h5>Low Stock Products</h5>
                            <div class="low-stock-list mt-2">
                                <ul class="list-group">
                                    @forelse ($lowStockProducts as $product)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            {{ $product->name }}
                                            <span class="badge bg-warning rounded-pill">Qty: {{ $product->quantity }}</span>
                                        </li>
                                    @empty
                                        <li class="list-group-item">No low stock products.</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <footer class="text-center text-white py-3">
        <div>
            <p class="mb-0">© {{ date('Y') }} Ivory Glow. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
