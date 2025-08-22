<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ivory Glow - Staff Login</title>
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
            position: relative;
            overflow: hidden;
        }

        .glass {
            background: rgba(245, 245, 245, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(139, 90, 43, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, #8b5a2b, #6b4a22);
        }

        .glass:hover {
            transform: translateY(-5px);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            color: #8b5a2b;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #4b3b25;
            margin-bottom: 8px;
        }

        .form-control {
            background: rgba(245, 245, 245, 0.95);
            border: 1.5px solid #8b5a2b;
            color: #3c2f2f;
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #6b4a22;
            box-shadow: 0 0 8px rgba(107, 74, 34, 0.3);
            transform: scale(1.02);
            outline: none;
        }

        .btn-primary {
            background: #8b5a2b;
            color: #f5f5f5;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            width: 100%;
            padding: 14px;
            margin-top: 20px;
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px rgba(139, 90, 43, 0.4);
        }

        .btn-primary:hover {
            background: #6b4a22;
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(107, 74, 34, 0.5);
        }

        .btn-link {
            color: #8b5a2b;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .btn-link:hover {
            color: #6b4a22;
            text-decoration: underline;
        }

        .alert {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid #dc3545;
            color: #dc3545;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            padding: 10px;
        }

        /* Responsive Design */
        @media (max-width: 576px) {
            .glass {
                padding: 25px;
                margin: 20px;
            }
            h2 {
                font-size: 2rem;
            }
            .form-control {
                padding: 10px;
            }
            .btn-primary {
                padding: 12px;
            }
        }

        @media (max-width: 400px) {
            .glass {
                margin: 15px;
                padding: 20px;
            }
            h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="glass">
        <h2>Staff Login</h2>
        @if ($errors->any())
            <div class="alert">
                {{ $errors->first() }}
            </div>
        @endif
        <form action="{{ route('staff.login.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="text-center mt-4">
            <a href="/" class="btn-link">← Back to Home</a>
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add subtle animation on form focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.style.transform = 'translateY(-2px)';
            });
            input.addEventListener('blur', () => {
                input.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>