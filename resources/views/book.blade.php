<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ivory Glow - Book Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f5f5, #e0d8c3);
            color: #3c2f2f;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .glass {
            background: rgba(245, 245, 245, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            padding: 30px;
            max-width: 500px;
            width: 100%;
        }

        h2 {
            font-family: 'Playfair Display', serif;
            color: #3c2f2f;
            text-align: center;
            margin-bottom: 20px;
        }

        .service-details {
            background: rgba(245, 245, 245, 0.9);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .service-details p {
            margin: 0 0 10px;
            font-size: 0.9rem;
        }

        .service-details p strong {
            color: #8b5a2b;
        }

        .form-control {
            background: rgba(245, 245, 245, 0.9);
            border: 1px solid rgba(139, 90, 43, 0.3);
            color: #3c2f2f;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .form-control:focus {
            border-color: #8b5a2b;
            box-shadow: none;
        }

        .btn-primary {
            background: #8b5a2b;
            color: #f5f5f5;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            width: 100%;
            padding: 12px;
        }

        .btn-primary:hover {
            background: #6b4a22;
        }

        .btn-link {
            color: #8b5a2b;
            text-decoration: none;
        }

        .btn-link:hover {
            color: #6b4a22;
            text-decoration: underline;
        }

        .error {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        @media (max-width: 576px) {
            .glass {
                padding: 20px;
                margin: 15px;
            }
            h2 {
                font-size: 1.8rem;
            }
        }

        .booked-slots-table {
            margin-bottom: 20px;
            background: rgba(245, 245, 245, 0.9);
            border-radius: 10px;
            padding: 15px;
        }
        .booked-slots-table th, .booked-slots-table td {
            padding: 10px;
            text-align: left;
        }
        .booked-slots-table th {
            background: #8b5a2b;
            color: #f5f5f5;
        }
        .booked-slots-table tr:nth-child(even) {
            background: rgba(139, 90, 43, 0.1);
        }
    </style>
</head>
<body>
    <div class="glass">
        <h2>Book Appointment</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if ($service)
            <div class="service-details">
                <p><strong>Service:</strong> {{ $service->name }}</p>
                <p><strong>Duration:</strong> {{ $service->duration }} minutes</p>
                <p><strong>Price:</strong> ${{ number_format($service->price, 2) }}</p>
                <p><strong>Staff:</strong> {{ $service->staff ? $service->staff->name . ' (' . $service->staff->position . ')' : 'No Staff Assigned' }}</p>
            </div>

            <!-- Booked Slots Table -->
            @if (!empty($bookedSlots))
                <div class="booked-slots-table">
                    <h4>Booked Slots</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookedSlots as $slot)
                                <tr>
                                    <td>{{ $slot['date'] }}</td>
                                    <td>{{ $slot['time'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No booked slots for this service.</p>
            @endif
        @else
            <div class="alert alert-danger">
                No service selected. Please choose a service from the home page.
            </div>
        @endif
        <form action="{{ route('book.store') }}" method="POST">
            @csrf
            @if ($service)
                <input type="hidden" name="service_id" value="{{ $service->id }}">
            @endif
            <div>
                <label for="appointment_date" class="form-label">Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror" value="{{ old('appointment_date') }}" required min="{{ date('Y-m-d') }}">
                @error('appointment_date')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="appointment_time" class="form-label">Time</label>
                <select name="appointment_time" id="appointment_time" class="form-control @error('appointment_time') is-invalid @enderror" required>
                    @foreach ($timeSlots as $slot)
                        <option value="{{ $slot }}" {{ old('appointment_time') == $slot ? 'selected' : '' }}>{{ $slot }}</option>
                    @endforeach
                </select>
                @error('appointment_time')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Book Now</button>
        </form>
        <p class="text-center mt-3">
            <a href="{{ route('home') }}" class="btn btn-link">Back to Home</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Restrict date to today or later
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('appointment_date').setAttribute('min', today);

        // Booked slots for JavaScript validation
        const bookedSlots = @json($bookedSlots);

        // Validate time selection
        const dateInput = document.getElementById('appointment_date');
        const timeInput = document.getElementById('appointment_time');
        const form = document.querySelector('form');

        form.addEventListener('submit', function(e) {
            const selectedDate = dateInput.value;
            const selectedTime = timeInput.value;

            // Check if the selected date and time are booked
            const isBooked = bookedSlots.some(slot => 
                slot.date === selectedDate && slot.time === selectedTime
            );

            if (isBooked) {
                e.preventDefault();
                alert('This date and time slot is already booked. Please choose another.');
            }
        });
    </script>
</body>
</html>