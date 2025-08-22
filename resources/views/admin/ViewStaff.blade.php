<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff List - Ivory Glow</title>
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

        h3 {
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

        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--highlight-color);
            border-color: var(--highlight-color);
            transform: scale(1.05);
        }

        .btn-toggle {
            background-color: var(--secondary-accent);
            border-color: var(--secondary-accent);
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
            min-width: 100px;
        }

        .btn-toggle:hover {
            background-color: var(--highlight-color);
            border-color: var(--highlight-color);
            transform: scale(1.05);
        }

        .btn-edit {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-edit:hover {
            background-color: var(--highlight-color);
            border-color: var(--highlight-color);
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: var(--secondary-accent);
            border-color: var(--secondary-accent);
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-delete:hover {
            background-color: #5c636a;
            border-color: #5c636a;
            transform: scale(1.05);
        }

        .profile-picture {
            max-width: 50px;
            height: auto;
            border-radius: 8px;
            object-fit: cover;
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

            h3 {
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
                font-size anticoagulants: 0.85rem;
                padding: 0.5rem;
            }

            h3 {
                font-size: 1.75rem;
            }

            .btn-primary, .btn-toggle, .btn-edit, .btn-delete {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }

            .btn-toggle {
                min-width: 80px;
            }

            .profile-picture {
                max-width: 40px;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <h3 class="text-center">Staff List</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="glass">
            <a href="{{ route('staff.create') }}" class="btn btn-primary mb-3">Add New Staff</a>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Profile Picture</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Position</th>
                                <th>Working Days</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($staff as $member)
                                <tr>
                                    <td>
                                        @if($member->profile_picture)
                                            <img src="{{ asset('storage/' . $member->profile_picture) }}" alt="{{ $member->name }}" class="profile-picture">
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->position }}</td>
                                    <td>{{ $member->working_days }}</td>
                                    <td>
                                        <form action="{{ route('staff.toggle', $member->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-toggle" onclick="return confirm('Are you sure you want to {{ $member->active ? 'deactivate' : 'activate' }} this staff?')">
                                                {{ $member->active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('staff.edit', $member->id) }}" class="btn btn-sm btn-edit me-1">Edit</a>
                                        <form action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure you want to delete this staff?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No staff found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>