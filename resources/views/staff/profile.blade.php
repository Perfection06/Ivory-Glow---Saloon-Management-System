<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Profile - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e6ecf0);
            color: #2f2f2f;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        .main-content {
            margin-left: 220px;
            padding: 40px 20px;
        }
        .section {
            min-height: 100vh;
            padding: 60px 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .glass {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease-in-out;
        }
        .glass:hover {
            transform: scale(1.01);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.18);
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #0d6efd;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        .btn-edit {
            background: #0d6efd;
            color: #fff;
            border-radius: 10px;
            padding: 8px 20px;
            transition: 0.3s;
        }
        .btn-edit:hover {
            background: #0b5ed7;
        }
        .modal-content {
            background: #ffffffee;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }
        h5 {
            margin-bottom: 10px;
            font-weight: 500;
        }
        footer {
            background: #0d6efd;
            color: white;
            padding: 15px;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 30px 10px;
            }
            .section {
                padding: 40px 10px;
            }
            .profile-picture {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>
<body>
    @include('staff.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="container">
                <h2 class="text-center mb-5">Staff Profile</h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="glass mx-auto" style="max-width: 600px;">
                    <div class="text-center mb-4">
                        @if ($staff->profile_picture)
                            <img src="{{ Storage::url($staff->profile_picture) }}" alt="Profile Picture" class="profile-picture">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Default Profile Picture" class="profile-picture">
                        @endif
                    </div>
                    <div class="text-start">
                        <h5>Name: {{ $staff->name }}</h5>
                        <h5>Email: {{ $staff->email }}</h5>
                        <h5>Phone: {{ $staff->phone ?? 'Not provided' }}</h5>
                        <h5>Position: {{ $staff->position ?? 'Not provided' }}</h5>
                        <h5>Working Days: {{ $staff->working_days ?? 'Not provided' }}</h5>
                        <h5>Status: {{ $staff->active ? 'Active' : 'Inactive' }}</h5>

                        <div class="text-center mt-4">
                            <button class="btn btn-edit" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                        </div>
                    </div>
                </div>

                <!-- Edit Profile Modal -->
                <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('staff.profile.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $staff->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $staff->phone }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="profile_picture" class="form-label">Profile Picture</label>
                                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password (optional)</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-edit">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
