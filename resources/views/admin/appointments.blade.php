<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Appointments - Ivory Glow</title>
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

        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            box-shadow: 0 8px 24px var(--shadow-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass p{
            color: black;
        }

        .glass:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px var(--shadow-color);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--text-color);
            text-shadow: 0 1px 2px var(--shadow-color);
            margin-bottom: 2rem;
        }

        .table {
            background: var(--glass-bg);
            border-radius: 10px;
            overflow: hidden;
        }

        .table th {
            background: var(--table-header-bg);
            color: #ffffff;
            font-weight: 500;
            padding: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.1);
        }

        .table-hover tbody tr:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .btn-info {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-info:hover {
            background-color: var(--highlight-color);
            border-color: var(--highlight-color);
            transform: scale(1.05);
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.5em 1em;
            border-radius: 12px;
            background-color: var(--secondary-accent);
            color: #ffffff;
        }

        .invoice-details {
            background: var(--glass-bg);
            border-left: 4px solid var(--accent-color);
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1rem;
            color: var(--text-color);
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        footer {
            background: var(--table-header-bg);
            color: #ffffff;
            padding: 1.5rem;
            font-size: 0.9rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
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

            .table {
                font-size: 0.9rem;
            }

            .table th, .table td {
                padding: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .table-responsive {
                border: none;
            }

            .table th, .table td {
                font-size: 0.85rem;
                padding: 0.5rem;
            }

            h2 {
                font-size: 1.75rem;
            }

            .btn-info {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .invoice-details {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="container">
                <h2 class="text-center mb-4">Manage Appointments</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="glass p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="text-center">
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Customer</th>
                                    <th>Service</th>
                                    <th>Staff</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($appointments as $appointment)
                                    <tr class="text-center">
                                        <td>{{ $appointment->appointment_date }}</td>
                                        <td>{{ $appointment->appointment_time }}</td>
                                        <td>{{ $appointment->customer->name }}</td>
                                        <td>{{ $appointment->service->name }}</td>
                                        <td>{{ $appointment->staff->name }}</td>
                                        <td><span class="badge">{{ ucfirst($appointment->status) }}</span></td>
                                        <td>
                                            <button class="btn btn-info btn-sm" data-bs-toggle="collapse" data-bs-target="#invoice-{{ $appointment->id }}">View Invoice</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="7" class="p-0">
                                            <div class="collapse" id="invoice-{{ $appointment->id }}">
                                                <div class="invoice-details">
                                                    @if ($appointment->invoice)
                                                        <h5>Invoice Details</h5>
                                                        <p><strong>Service Price:</strong> Rs.{{ $appointment->invoice->service_price }}</p>
                                                        @if ($appointment->invoice->staffProducts->isNotEmpty())
                                                            <h6>Additional Products:</h6>
                                                            <ul>
                                                                @foreach ($appointment->invoice->staffProducts as $product)
                                                                    <li>{{ $product->product->name }} - {{ $product->quantity }} x Rs.{{ $product->total_price / $product->quantity }} = Rs.{{ $product->total_price }}</li>
                                                                @endforeach
                                                            </ul>
                                                            <p><strong>Total:</strong> Rs.{{ $appointment->invoice->service_price + $appointment->invoice->staffProducts->sum('total_price') }}</p>
                                                        @else
                                                            <p>No additional products.</p>
                                                        @endif
                                                    @else
                                                        <p>No invoice generated.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No appointments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>