<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #ffffff;
            --text-color: #343a40;
            --accent-color: #343a40;
            --secondary-accent: #6c757d;
            --highlight-color: #495057;
            --table-header-bg: #343a40;
            --glass-bg: rgba(255, 255, 255, 0.8);
            --shadow-color: rgba(0, 0, 0, 0.2);
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background: var(--primary-bg);
            color: var(--text-color);
            scroll-behavior: smooth;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            transition: margin-left 0.3s ease;
        }

        .section {
            padding: 3rem 1rem;
            min-height: calc(100vh - 80px);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--text-color);
            text-shadow: 0 1px 2px var(--shadow-color);
            margin-bottom: 2rem;
        }

        .welcome-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 24px var(--shadow-color);
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 24px var(--shadow-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 2rem;
        }

        .glass:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px var(--shadow-color);
        }

        .widget {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            cursor: pointer; /* Make widget clickable */
        }

        .widget:hover {
            transform: translateY(-3px);
        }

        .widget h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1.5rem;
        }

        .widget p {
            font-size: 1rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .widget-table {
            background: var(--glass-bg);
            border-radius: 8px;
            overflow: hidden;
        }

        .widget-table th {
            background: var(--table-header-bg);
            color: #ffffff;
            font-weight: 500;
            padding: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .widget-table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.1);
        }

        .widget-table tbody tr:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5em 1em;
            border-radius: 12px;
            background-color: var(--secondary-accent);
            color: #ffffff;
        }

        .display-6 {
            font-size: 3rem;
            font-weight: 700;
            color: var(--accent-color);
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .modal-content {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .modal-header, .modal-footer {
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .section {
                padding: 2rem 1rem;
            }

            h2 {
                font-size: 2rem;
            }

            .display-6 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .widget {
                margin-bottom: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.75rem;
            }

            .widget {
                padding: 1.5rem;
            }

            .widget h5 {
                font-size: 1.25rem;
            }

            .widget p, .widget-table td, .widget-table th {
                font-size: 0.9rem;
            }

            .widget-table th, .widget-table td {
                padding: 0.75rem;
            }

            .display-6 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    @include('staff.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="container">
                <div class="welcome-card">
                    <h3>Welcome, {{ Auth::guard('staff')->user()->name }}!</h3>
                    <p>Your dashboard for {{ now()->format('F j, Y') }}</p>
                </div>

                <h2 class="text-center mb-5">Staff Dashboard</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="row">
                    <!-- Today's Schedule -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="widget glass" onclick="openScheduleModal()">
                            <h5>Today's Schedule</h5>
                            <p class="display-6">{{ $todayAppointments->count() }}</p>
                            <p class="text-muted">Appointments today</p>
                        </div>
                    </div>

                    <!-- Appointments Handled -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="widget glass">
                            <h5>Appointments Handled</h5>
                            <p class="display-6">{{ $completedAppointments }}</p>
                            <p class="text-muted">This month</p>
                        </div>
                    </div>

                    <!-- New Booking Alerts -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="widget glass">
                            <h5>New Booking Alerts</h5>
                            <p class="display-6">{{ $newBookings }}</p>
                            <p class="text-muted">Pending bookings</p>
                        </div>
                    </div>

                    <!-- Working Days -->
                    <div class="col-lg-3 col-md-6 col-12">
                        <div class="widget glass">
                            <h5>Working Days</h5>
                            <p class="display-6">{{ Auth::guard('staff')->user()->working_days }}</p>
                            <p class="text-muted">Your schedule</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Today's Schedule Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleModalLabel">Today's Appointments</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="glass p-4">
                        @if ($todayAppointments->isNotEmpty())
                            <div class="table-responsive">
                                <table class="widget-table table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Service</th>
                                            <th>Time</th>
                                            <th>Customer</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($todayAppointments as $appointment)
                                            <tr>
                                                <td>{{ $appointment->service->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                                <td>{{ $appointment->customer->name ?? 'N/A' }}</td>
                                                <td><span class="badge">{{ ucfirst($appointment->status) }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No appointments scheduled for today.</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openScheduleModal() {
            const modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
            modal.show();
        }
    </script>
</body>
</html>