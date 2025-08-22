<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers Management - Ivory Glow</title>
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

        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 24px var(--shadow-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 1.5rem;
        }

        .glass:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px var(--shadow-color);
        }

        .customer-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .customer-card:hover {
            transform: translateY(-3px);
        }

        .customer-card h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .customer-card p {
            font-size: 0.95rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .customer-card h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--text-color);
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .booking-table {
            background: var(--glass-bg);
            border-radius: 8px;
            overflow: hidden;
        }

        .booking-table th {
            background: var(--table-header-bg);
            color: #ffffff;
            font-weight: 500;
            padding: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .booking-table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.1);
        }

        .booking-table tbody tr:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5em 1em;
            border-radius: 12px;
            background-color: var(--secondary-accent);
            color: #ffffff;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
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
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.75rem;
            }

            .customer-card {
                padding: 1rem;
            }

            .customer-card h5 {
                font-size: 1.25rem;
            }

            .customer-card p, .booking-table td, .booking-table th {
                font-size: 0.85rem;
            }

            .booking-table th, .booking-table td {
                padding: 0.5rem;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="container">
                <h2 class="text-center mb-5">Customers Management</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="glass">
                    @forelse ($customers as $customer)
                        <div class="customer-card">
                            <h5>{{ $customer->name }}</h5>
                            <p><strong>Email:</strong> {{ $customer->email }}</p>
                            <p><strong>Phone:</strong> {{ $customer->phone_number ?? 'Not provided' }}</p>
                            <h6>Bookings:</h6>
                            @if ($customer->bookings->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="booking-table table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customer->bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->service->name }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($booking->appointment_date)->format('Y-m-d') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($booking->appointment_time)->format('h:i A') }}</td>
                                                    <td><span class="badge">{{ ucfirst($booking->status) }}</span></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No bookings yet.</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-center">No customers registered.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>