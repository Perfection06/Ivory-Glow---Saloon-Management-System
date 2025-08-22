<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Staff - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-content {
            margin-left: 220px;
            padding: 30px;
        }
        .form-control:focus {
            border-color: #495057;
            box-shadow: 0 0 0 0.2rem rgba(73, 80, 87, 0.25);
        }
        .btn-primary {
            background-color: #495057;
            border-color: #495057;
        }
        .btn-primary:hover {
            background-color: #343a40;
            border-color: #343a40;
        }
    </style>
</head>
<body>

    @include('admin.sidebar')

    <div class="main-content">
        <h3>Add Staff</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <select name="position" id="position" class="form-control" required>
                    <option value="" disabled selected>Select Position</option>
                    @foreach([
                        'Stylist', 'Hairdresser', 'Barber', 'Colorist', 'Beautician',
                        'Skin Care Specialist', 'Massage Therapist', 'Nail Technician'
                    ] as $role)
                        <option value="{{ $role }}" {{ old('position') == $role ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Working Days</label>
                @php
                    $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                    $oldDays = old('working_days', []);
                    if (!is_array($oldDays)) {
                        $oldDays = explode(',', $oldDays);
                    }
                @endphp
                @foreach($days as $day)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="working_days[]" value="{{ $day }}" id="day_{{ $day }}"
                            {{ in_array($day, $oldDays) ? 'checked' : '' }}>
                        <label class="form-check-label" for="day_{{ $day }}">{{ $day }}</label>
                    </div>
                @endforeach
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Add Staff</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>