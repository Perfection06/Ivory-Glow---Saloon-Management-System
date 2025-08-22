<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Customer Notes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f5f5, #e0d8c3);
            color: #3c2f2f;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        .section {
            min-height: 100vh;
            padding: 80px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .glass {
            background: rgba(245, 245, 245, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .customer-details p {
            margin: 0 0 10px;
            font-size: 1rem;
        }
        .customer-details p strong {
            color: #8b5a2b;
        }
        .alert {
            border-radius: 10px;
        }
        footer {
            background: #8b5a2b;
            padding: 20px;
            font-size: 0.9rem;
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
                <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif;">Add Customer Notes</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif
                <div class="customer-details glass">
                    <h4>Customer Details</h4>
                    <p><strong>Name:</strong> {{ $booking->customer->name }}</p>
                    <p><strong>Email:</strong> {{ $booking->customer->email }}</p>
                    <p><strong>Phone:</strong> {{ $booking->customer->phone_number ?? 'Not provided' }}</p>
                    <p><strong>Service:</strong> {{ $booking->service->name }}</p>
                    <p><strong>Date:</strong> {{ $booking->appointment_date->format('Y-m-d') }}</p>
                    <p><strong>Time:</strong> {{ $booking->appointment_time }}</p>
                </div>
                <form action="{{ route('staff.customers.notes', $booking->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Service Notes</label>
                        <textarea name="notes" class="form-control" rows="5" required>{{ $booking->notes ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Notes</button>
                </form>
            </div>
        </section>
    </div>

    <footer class="text-center text-white">
        <div class="glass p-3">
            <p>© {{ date('Y') }} SalonPro. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>