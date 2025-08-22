<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Settings - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f5f5, #e0d8c3);
            color: #3c2f2f;
            overflow-x: hidden;
        }

        .main-content {
            margin-left: 220px;
            padding: 40px 20px;
        }

        .section {
            padding: 20px 10px;
        }

        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .glass input.form-control {
            border-radius: 10px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .glass input.form-control:focus {
            border-color: #6c757d;
            box-shadow: 0 0 0 0.15rem rgba(108, 117, 125, 0.25);
        }

        .btn-primary {
            background-color: #343a40;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #495057;
            box-shadow: 0 5px 15px rgba(73, 80, 87, 0.3);
        }

        footer {
            margin-left: 220px;
        }

        footer .glass {
            background: rgba(52, 58, 64, 0.9);
            color: #fff;
            border-radius: 0;
            box-shadow: none;
        }

        @media (max-width: 768px) {
            .main-content,
            footer {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="container">
                <h2 class="text-center mb-4" style="font-family: 'Playfair Display', serif;">My Settings</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="glass">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
