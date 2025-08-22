<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ivory Glow - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: url('{{ asset('storage/images/bg.jpg') }}') no-repeat center center/cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(139, 90, 43, 0.7), rgba(60, 47, 47, 0.7));
            z-index: 1;
        }

        .login-container {
            background: #f5f5f5;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            position: relative;
            z-index: 2;
        }

        h2 {
            font-family: 'Playfair Display', serif;
            color: #8b5a2b;
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .form-label {
            color: #3c2f2f;
            font-weight: 600;
        }

        .form-control {
            background: #ffffff;
            border: 1px solid #8b5a2b;
            border-radius: 8px;
            color: #3c2f2f;
            padding: 10px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #d4a373;
            box-shadow: 0 0 8px rgba(212, 163, 115, 0.3);
        }

        .input-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8b5a2b;
            font-size: 1.2rem;
        }

        .password-toggle:hover {
            color: #d4a373;
        }

        .btn-primary {
            background: #8b5a2b;
            color: #f5f5f5;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            width: 100%;
            padding: 12px;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background: #d4a373;
            transform: translateY(-2px);
        }

        .btn-link {
            color: #8b5a2b;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-link:hover {
            color: #d4a373;
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .profile-dropdown {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 3;
        }

        .profile-dropdown .btn {
            background: #8b5a2b;
            color: #f5f5f5;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            transition: background 0.3s ease;
        }

        .profile-dropdown .btn:hover {
            background: #d4a373;
        }

        .profile-dropdown .dropdown-menu {
            background: #f5f5f5;
            border: 1px solid #8b5a2b;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .profile-dropdown .dropdown-item {
            color: #3c2f2f;
            font-weight: 600;
        }

        .profile-dropdown .dropdown-item:hover {
            background: #d4a373;
            color: #ffffff;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .brand-logo i {
            font-size: 3rem;
            color: #8b5a2b;
        }

        .social-login {
            text-align: center;
            margin-top: 20px;
        }

        .social-login p {
            color: #3c2f2f;
            font-size: 0.95rem;
            margin-bottom: 10px;
        }

        .social-login .btn {
            background: #ffffff;
            border: 1px solid #8b5a2b;
            color: #8b5a2b;
            border-radius: 8px;
            padding: 8px 15px;
            margin: 0 5px;
            transition: background 0.3s ease, color 0.3s ease;
        }

        .social-login .btn:hover {
            background: #8b5a2b;
            color: #f5f5f5;
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
                margin: 15px;
            }
            h2 {
                font-size: 2rem;
            }
            .profile-dropdown {
                top: 10px;
                right: 10px;
            }
            .profile-dropdown .btn {
                width: 40px;
                height: 40px;
            }
            .brand-logo i {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="profile-dropdown" data-aos="fade-down" data-aos-duration="600">
        <button class="btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="{{ route('staff.login') }}">Staff Login</a></li>
            <li><a class="dropdown-item" href="{{ route('admin.login') }}">Admin Login</a></li>
        </ul>
    </div>

    <div class="login-container animate__animated animate__fadeInUp" data-aos="zoom-in" data-aos-duration="800">
        <div class="brand-logo">
            <i class="fas fa-spa"></i>
        </div>
        <h2>Login to Ivory Glow</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->has('email'))
            <div class="alert alert-danger">
                {{ $errors->first('email') }}
            </div>
        @endif
        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    <i class="bi bi-eye-slash password-toggle" id="passwordToggle"></i>
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="text-center mt-3">
            Don't have an account? <a href="{{ route('register') }}" class="btn-link">Register</a>
        </p>
        <div class="social-login">
            <p>Or login with</p>
            <a href="#" class="btn"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="btn"><i class="fab fa-google"></i></a>
            <a href="#" class="btn"><i class="fab fa-instagram"></i></a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init();

        // Password toggle functionality
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('passwordToggle');

        passwordToggle.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('bi-eye-slash');
                passwordToggle.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('bi-eye');
                passwordToggle.classList.add('bi-eye-slash');
            }
        });
    </script>
</body>
</html>