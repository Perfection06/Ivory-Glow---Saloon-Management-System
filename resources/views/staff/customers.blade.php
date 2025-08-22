<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Management - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            color: #343a40;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
            margin-top: -100px;
        }
        .section {
            min-height: 100vh;
            padding: 80px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .glass {
            background: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .table {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #343a40;
            color: #ffffff;
            font-weight: 600;
        }
        .table td {
            color: #343a40;
        }
        .table tbody tr:hover {
            background: rgba(52, 58, 64, 0.05);
        }
        .alert {
            border-radius: 10px;
        }
        .btn-status, .btn-cancel, .btn-products, .btn-invoice {
            border-radius: 8px;
            font-size: 0.9rem;
            padding: 5px 10px;
        }
        .btn-status {
            background: #007bff;
            color: #ffffff;
        }
        .btn-status:hover {
            background: #0056b3;
        }
        .btn-cancel {
            background: #dc3545;
            color: #ffffff;
        }
        .btn-cancel:hover {
            background: #c82333;
        }
        .btn-products {
            background: #6f42c1;
            color: #ffffff;
        }
        .btn-products:hover {
            background: #5a32a3;
        }
        .btn-invoice {
            background: #28a745;
            color: #ffffff;
        }
        .btn-invoice:hover {
            background: #218838;
        }
        footer {
            background: #343a40;
            padding: 20px;
            font-size: 0.9rem;
            color: white;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            .section {
                min-height: auto;
                padding: 40px 15px;
            }
        }
    </style>
        </head>
            <body>
            @include('staff.sidebar')
            <div class="main-content">
            <section class="section">
            <div class="container">
            <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif;">Appointment Management</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>
                                        <button type="button" class="btn btn-details" data-bs-toggle="modal" data-bs-target="#customerModal{{ $customer->id }}">View Details</button>
                                    </td>
                                </tr>
                                <!-- Customer Details Modal -->
                                <div class="modal fade" id="customerModal{{ $customer->id }}" tabindex="-1" aria-labelledby="customerModalLabel{{ $customer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="customerModalLabel{{ $customer->id }}">Customer Details - {{ $customer->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body customer-details">
                                                <p><strong>Name:</strong> {{ $customer->name }}</p>
                                                <p><strong>Email:</strong> {{ $customer->email }}</p>
                                                <p><strong>Phone:</strong> {{ $customer->phone_number ?? 'Not provided' }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No customers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>