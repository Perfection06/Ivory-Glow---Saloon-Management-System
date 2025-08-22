<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Service - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    {{-- Custom layout styles --}}
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
        #name:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        .current-image {
            max-width: 100px;
            height: auto;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    {{-- Include Sidebar --}}
    @include('admin.sidebar')

    <div class="main-content">
        <h3>Edit Service</h3>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Service Form --}}
        <form method="POST" action="{{ route('service.update', $service->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="staff_id" class="form-label">Assign Staff</label>
                <select name="staff_id" id="staff_id" class="form-control" required>
                    <option value="" disabled>Select Staff</option>
                    @foreach($staff as $member)
                        <option value="{{ $member->id }}" data-position="{{ $member->position }}" {{ old('staff_id', $service->staff_id) == $member->id ? 'selected' : '' }}>
                            {{ $member->name }} ({{ $member->position }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Service Name</label>
                <select name="name" id="name" class="form-control" required>
                    <option value="" disabled>Select Service</option>
                    @if($service->name)
                        <option value="{{ $service->name }}" selected>{{ $service->name }}</option>
                    @endif
                </select>
            </div>

            <div class="mb-3">
                <label for="duration" class="form-label">Duration (minutes)</label>
                <input type="number" name="duration" id="duration" class="form-control" value="{{ old('duration', $service->duration) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $service->price) }}" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @if($service->image)
                    <div class="mt-2">
                        <p>Current Image:</p>
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="current-image">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update Service</button>
            <a href="{{ route('service.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('staff_id').addEventListener('change', function () {
            const serviceSelect = document.getElementById('name');
            const position = this.options[this.selectedIndex].getAttribute('data-position');

            // Clear existing options
            serviceSelect.innerHTML = '<option value="" disabled selected>Select Service</option>';

            // Define services by position
            const servicesByPosition = {
                'Stylist': ['Haircut', 'Hair Styling', 'Blowout', 'Updo'],
                'Hairdresser': ['Haircut', 'Hair Coloring', 'Perm', 'Hair Straightening'],
                'Barber': ['Men’s Haircut', 'Beard Trim', 'Shave', 'Fade'],
                'Colorist': ['Hair Coloring', 'Highlights', 'Balayage', 'Ombre'],
                'Beautician': ['Makeup Application', 'Eyebrow Shaping', 'Eyelash Extensions'],
                'Skin Care Specialist': ['Facial', 'Microdermabrasion', 'Chemical Peel', 'Waxing'],
                'Massage Therapist': ['Swedish Massage', 'Deep Tissue Massage', 'Hot Stone Massage', 'Aromatherapy'],
                'Nail Technician': ['Manicure', 'Pedicure', 'Nail Art', 'Gel Nails'],
                'Receptionist': [],
                'Cleaner': []
            };

            // Populate services or disable dropdown
            const services = servicesByPosition[position] || [];
            if (services.length === 0) {
                serviceSelect.disabled = true;
                serviceSelect.innerHTML = '<option value="" disabled selected>No services available</option>';
            } else {
                serviceSelect.disabled = false;
                services.forEach(service => {
                    const option = document.createElement('option');
                    option.value = service;
                    option.text = service;
                    if (service === '{{ old('name', $service->name) }}') {
                        option.selected = true;
                    }
                    serviceSelect.appendChild(option);
                });
            }
        });

        // Trigger change event on page load to populate services
        const staffSelect = document.getElementById('staff_id');
        if (staffSelect.value) {
            staffSelect.dispatchEvent(new Event('change'));
        }
    </script>
</body>
</html>