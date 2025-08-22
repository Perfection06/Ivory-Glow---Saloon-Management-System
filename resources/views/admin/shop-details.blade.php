<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ivory Glow - Shop Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
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
            margin: 0;
            padding-left: 240px;
        }

        .main-content {
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            box-shadow: 0 10px 30px var(--shadow-color);
            padding: 30px;
            transition: transform 0.3s ease;
        }

        .glass:hover {
            transform: translateY(-5px);
        }

        h2 {
            font-family: 'Playfair Display', serif;
            color: var(--text-color);
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-shadow: 0 2px 4px var(--shadow-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--text-color);
            margin-bottom: 8px;
        }

        .form-control {
            background: var(--glass-bg);
            border: 1.5px solid var(--accent-color);
            color: var(--text-color);
            border-radius: 12px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--highlight-color);
            box-shadow: 0 0 8px rgba(73, 80, 87, 0.3);
            transform: scale(1.02);
            outline: none;
        }

        .btn-primary {
            background: var(--accent-color);
            color: #ffffff;
            font-weight: 600;
            border-radius: 12px;
            border: none;
            width: 100%;
            padding: 14px;
            margin-top: 20px;
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px var(--shadow-color);
        }

        .btn-primary:hover {
            background: var(--highlight-color);
            transform: translateY(-3px);
            box-shadow: 0 7px 20px rgba(73, 80, 87, 0.5);
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            color: #28a745;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            padding: 10px;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            border: 1px solid #dc3545;
            color: #dc3545;
            border-radius: 10px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            padding: 10px;
        }

        @media (max-width: 768px) {
            body {
                padding-left: 0;
            }
            .main-content {
                padding: 20px;
            }
            .glass {
                padding: 20px;
            }
            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <div class="glass">
            <h2>Shop Details</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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
            <form action="{{ route('admin.shop-details.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $shop ? $shop->address : '') }}" required>
                    @error('address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $shop ? $shop->phone : '') }}" required>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $shop ? $shop->email : '') }}" required>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="start_time" class="form-label">Start Time</label>
                    <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time', $shop && $shop->opening_hours ? explode(' - ', $shop->opening_hours)[0] : '') }}" required>
                    @error('start_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="end_time" class="form-label">End Time</label>
                    <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time', $shop && $shop->opening_hours && count(explode(' - ', $shop->opening_hours)) > 1 ? explode(' - ', $shop->opening_hours)[1] : '') }}" required>
                    @error('end_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="facebook_url" class="form-label">Facebook URL (Optional)</label>
                    <input type="url" name="facebook_url" id="facebook_url" class="form-control @error('facebook_url') is-invalid @enderror" value="{{ old('facebook_url', $shop ? $shop->facebook_url : '') }}">
                    @error('facebook_url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="instagram_url" class="form-label">Instagram URL (Optional)</label>
                    <input type="url" name="instagram_url" id="instagram_url" class="form-control @error('instagram_url') is-invalid @enderror" value="{{ old('instagram_url', $shop ? $shop->instagram_url : '') }}">
                    @error('instagram_url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="twitter_url" class="form-label">Twitter URL (Optional)</label>
                    <input type="url" name="twitter_url" id="twitter_url" class="form-control @error('twitter_url') is-invalid @enderror" value="{{ old('twitter_url', $shop ? $shop->twitter_url : '') }}">
                    @error('twitter_url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="map_embed_url" class="form-label">Map Embed URL (Optional)</label>
                    <textarea name="map_embed_url" id="map_embed_url" class="form-control @error('map_embed_url') is-invalid @enderror" rows="4">{{ old('map_embed_url', $shop ? $shop->map_embed_url : '') }}</textarea>
                    @error('map_embed_url')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Save Shop Details</button>
            </form>
        </div>
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