<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ivory Glow - Luxury Salon Experience</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f5f5;
            color: #3c2f2f;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        /* Navigation */
        .navbar {
            background: #8b5a2b;
            padding: 15px 0;
            transition: all 0.3s ease;
        }
        .navbar.sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #f5f5f5;
        }
        .navbar-nav .nav-link {
            color: #f5f5f5;
            font-weight: 600;
            margin: 0 15px;
            transition: color 0.3s ease;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #d4a373;
        }
        .navbar .btn {
            background: #f5f5f5;
            color: #3c2f2f;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px 20px;
            margin-left: 10px;
        }
        .navbar .btn:hover {
            background: #d4a373;
            color: #ffffff;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            background: url('{{ asset('../storage/images/bg.jpg') }}') no-repeat center center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #f5f5f5;
            overflow: hidden;
            background-attachment: fixed;
        }
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(139, 90, 43, 0.6), rgba(60, 47, 47, 0.6));
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 40px;
            background: rgba(245, 245, 245, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            color: #3c2f2f;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.5rem;
            color: #3c2f2f;
            margin-bottom: 30px;
        }
        .hero .btn-primary {
            background: #8b5a2b;
            color: #f5f5f5;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
        }
        .hero .btn-primary:hover {
            background: #d4a373;
            transform: translateY(-3px);
        }

        /* Sections */
        .section {
            padding: 80px 0;
            background: #ffffff;
            border-radius: 20px;
            margin: 20px auto;
            max-width: 1200px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .section.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            color: #8b5a2b;
            text-align: center;
            margin-bottom: 40px;
        }

        /* About Section */
        #about .content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }
        #about h4 {
            font-size: 1.8rem;
            color: #3c2f2f;
            margin-bottom: 20px;
        }
        #about p {
            font-size: 1.1rem;
            color: #3c2f2f;
            line-height: 1.8;
            margin-bottom: 20px;
        }
        #about ul {
            list-style: none;
            padding: 0;
            text-align: left;
            max-width: 500px;
            margin: 0 auto;
        }
        #about ul li {
            font-size: 1.1rem;
            color: #3c2f2f;
            margin-bottom: 15px;
            padding-left: 1.5em;
            position: relative;
        }
        #about ul li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #8b5a2b;
            font-weight: 700;
        }

        /* Services & Staff Cards */
        .service-card, .staff-card {
            background: #f5f5f5;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover, .staff-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }
        .service-card img, .staff-card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            height: 200px;
            object-fit: cover;
        }
        .service-card .card-body, .staff-card .card-body {
            padding: 20px;
            color: #3c2f2f;
        }
        .service-card .btn, .staff-card .btn {
            background: #8b5a2b;
            color: #f5f5f5;
            font-weight: 600;
            border-radius: 8px;
            padding: 10px 20px;
        }
        .service-card .btn:hover, .staff-card .btn:hover {
            background: #d4a373;
        }

        /* Contact Section */
        #contact .contact-form, #contact .contact-info {
            background: #f5f5f5;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }
        #contact h4 {
            font-size: 1.8rem;
            color: #3c2f2f;
            margin-bottom: 20px;
        }
        #contact .contact-info p {
            font-size: 1.1rem;
            color: #3c2f2f;
            margin-bottom: 15px;
        }
        #contact .contact-info i {
            color: #8b5a2b;
            margin-right: 10px;
        }
        #contact .social-icons a {
            color: #8b5a2b;
            font-size: 1.5rem;
            margin-right: 15px;
            transition: color 0.3s ease;
        }
        #contact .social-icons a:hover {
            color: #d4a373;
        }
        #contact iframe {
            border-radius: 15px;
            width: 100%;
            height: 250px;
        }
        .contact-form .form-control {
            border: 1px solid #8b5a2b;
            border-radius: 8px;
            padding: 10px;
            color: #3c2f2f;
        }
        .contact-form .form-control:focus {
            border-color: #d4a373;
            box-shadow: none;
        }
        .contact-form .btn-primary {
            background: #8b5a2b;
            color: #f5f5f5;
            border-radius: 8px;
            padding: 12px 20px;
            width: 100%;
        }
        .contact-form .btn-primary:hover {
            background: #d4a373;
        }

        /* Modals */
        .modal-content {
            background: #f5f5f5;
            border-radius: 15px;
            color: #3c2f2f;
        }
        .modal-header, .modal-body {
            border: none;
        }
        .modal-title {
            font-family: 'Playfair Display', serif;
            color: #8b5a2b;
        }
        .modal .form-control {
            border: 1px solid #8b5a2b;
            border-radius: 8px;
        }
        .modal .form-control:focus {
            border-color: #d4a373;
            box-shadow: none;
        }
        .modal .btn-primary {
            background: #8b5a2b;
            color: #f5f5f5;
            border-radius: 8px;
        }
        .modal .btn-primary:hover {
            background: #d4a373;
        }

        /* Footer */
        footer {
            background: #8b5a2b;
            color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 0.95rem;
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .navbar-nav {
                text-align: center;
            }
            .navbar .btn {
                margin: 10px auto;
                width: 80%;
            }
            .hero h1 {
                font-size: 2.5rem;
            }
            .hero p {
                font-size: 1.2rem;
            }
            .section {
                padding: 50px 20px;
                margin: 15px;
            }
            .section h2 {
                font-size: 2.2rem;
            }
        }
        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2rem;
            }
            .hero-content {
                padding: 20px;
            }
            .section h2 {
                font-size: 1.8rem;
            }
            .service-card img, .staff-card img {
                height: 150px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">Ivory Glow</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#staff">Our Team</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    @if (Auth::guard('web')->check())
                        <li class="nav-item"><a href="{{ route('settings') }}" class="btn">My Settings</a></li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="btn">Login</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="btn">Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero section">
        <div class="hero-content">
            <h1>Welcome to Ivory Glow</h1>
            <p>Indulge in luxury and personalized care at its finest.</p>
            <a href="#services" class="btn btn-primary">Book Your Appointment</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container content">
            <h2>About Us</h2>
            <h4>Our Story</h4>
            <p>Since 2015, Ivory Glow has been a sanctuary for beauty and wellness, offering transformative experiences with a commitment to excellence.</p>
            <h4>Our Mission</h4>
            <p>We empower our clients with personalized, eco-friendly beauty solutions to enhance confidence and radiance.</p>
            <h4>Why Choose Us</h4>
            <ul>
                <li><strong>Excellence:</strong> Premium products for stunning, lasting results.</li>
                <li><strong>Personalization:</strong> Services tailored to your unique style.</li>
                <li><strong>Sustainability:</strong> Eco-conscious practices in every detail.</li>
                <li><strong>Community:</strong> Building meaningful connections with our clients.</li>
            </ul>
            <a href="#contact" class="btn btn-primary">Get in Touch</a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <div class="container">
            <h2>Our Services</h2>
            <div class="row g-4">
                @forelse($services->take(3) as $service)
                    <div class="col-md-4">
                        <div class="card service-card">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200?text={{ urlencode($service->name) }}" class="card-img-top" alt="{{ $service->name }}">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $service->name }}</h5>
                                <p class="card-text">{{ Str::limit($service->description, 80) }}</p>
                                <p class="card-text"><strong>Price:</strong> Rs. {{ number_format($service->price, 2) }}</p>
                                <p class="card-text"><strong>Duration:</strong> {{ $service->duration }} min</p>
                                <a href="{{ Auth::guard('web')->check() ? route('book', ['service_id' => $service->id]) : route('login') }}" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No services available at the moment.</p>
                    </div>
                @endforelse
            </div>
            @if($services->count() > 0)
                <div class="text-center mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#servicesModal">View All Services</button>
                </div>
            @endif
        </div>
    </section>

    <!-- Staff Section -->
    <section id="staff" class="section">
        <div class="container">
            <h2>Our Team</h2>
            <div class="row g-4">
                @forelse($staff as $member)
                    <div class="col-md-4">
                        <div class="card staff-card">
                            @if($member->profile_picture)
                                <img src="{{ asset('storage/' . $member->profile_picture) }}" class="card-img-top" alt="{{ $member->name }}">
                            @else
                                <img src="https://via.placeholder.com/300x200?text={{ urlencode($member->name) }}" class="card-img-top" alt="{{ $member->name }}">
                            @endif
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $member->name }}</h5>
                                <p class="card-text">{{ $member->position }}</p>
                                <p class="card-text"><small>Available: {{ $member->working_days }}</small></p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No staff members available at the moment.</p>
                    </div>
                @endforelse
            </div>
            @if($staff->count() > 0)
                <div class="text-center mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staffModal">View All Staff</button>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <h2>Contact Us</h2>
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
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="contact-form">
                        <h4>Send Us a Message</h4>
                        <form action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-info">
                        <h4>Contact Details</h4>
                        @if ($shop)
                            <p><i class="bi bi-geo-alt me-2"></i> {{ $shop->address }}</p>
                            <p><i class="bi bi-phone me-2"></i> {{ $shop->phone }}</p>
                            <p><i class="bi bi-envelope me-2"></i> {{ $shop->email }}</p>
                            <p><i class="bi bi-clock me-2"></i> {{ $shop->opening_hours }}</p>
                            <h5 class="mt-4">Follow Us</h5>
                            <div class="social-icons">
                                @if ($shop->facebook_url)
                                    <a href="{{ $shop->facebook_url }}" class="me-2"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if ($shop->instagram_url)
                                    <a href="{{ $shop->instagram_url }}" class="me-2"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if ($shop->twitter_url)
                                    <a href="{{ $shop->twitter_url }}" class="me-2"><i class="bi bi-twitter"></i></a>
                                @endif
                            </div>
                            @if ($shop->map_embed_url)
                                <iframe src="{{ $shop->map_embed_url }}" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            @else
                                <p>No map available.</p>
                            @endif
                        @else
                            <p>No shop details available at the moment.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Modal -->
    <div class="modal fade" id="servicesModal" tabindex="-1" aria-labelledby="servicesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="servicesModalLabel">All Services</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" id="serviceSearch" class="form-control" placeholder="Search by service name">
                    </div>
                    <div class="row g-4" id="servicesList">
                        @foreach($services as $service)
                            <div class="col-md-6 service-item" data-service-name="{{ strtolower($service->name) }}">
                                <div class="card service-card">
                                    @if($service->image)
                                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/300x200?text={{ urlencode($service->name) }}" class="card-img-top" alt="{{ $service->name }}">
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $service->name }}</h5>
                                        <p class="card-text">{{ $service->description }}</p>
                                        <p class="card-text"><strong>Price:</strong> Rs. {{ number_format($service->price, 2) }}</p>
                                        <p class="card-text"><strong>Duration:</strong> {{ $service->duration }} min</p>
                                        <a href="{{ Auth::guard('web')->check() ? route('book', ['service_id' => $service->id]) : route('login') }}" class="btn btn-primary">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff Modal -->
    <div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staffModalLabel">All Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <select id="staffPositionFilter" class="form-select">
                            <option value="">All Positions</option>
                            @foreach($positions as $position)
                                <option value="{{ $position }}">{{ $position }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row g-4" id="staffList">
                        @foreach($staff as $member)
                            <div class="col-md-6 staff-item" data-position="{{ strtolower($member->position) }}">
                                <div class="card staff-card">
                                    @if($member->profile_picture)
                                        <img src="{{ asset('storage/' . $member->profile_picture) }}" class="card-img-top" alt="{{ $member->name }}">
                                    @else
                                        <img src="https://via.placeholder.com/300x200?text={{ urlencode($member->name) }}" class="card-img-top" alt="{{ $member->name }}">
                                    @endif
                                    <div class="card-body text-center">
                                        <h5 class="card-title">{{ $member->name }}</h5>
                                        <p class="card-text">{{ $member->position }}</p>
                                        <p class="card-text"><small>Available: {{ $member->working_days }}</small></p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© {{ date('Y') }} Ivory Glow. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS and Custom Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sticky Navbar
        const navbar = document.querySelector('.navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('sticky');
            } else {
                navbar.classList.remove('sticky');
            }
        });

        // Smooth scrolling for nav links
        document.querySelectorAll('.nav-link, .hero .btn-primary').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                if (this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
        });

        // Section fade-in
        const sections = document.querySelectorAll('.section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });
        sections.forEach(section => observer.observe(section));

        // Highlight active nav link
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 150;
                if (window.scrollY >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href').substring(1) === current) {
                    link.classList.add('active');
                }
            });
        });

        // Service search
        const serviceSearch = document.getElementById('serviceSearch');
        const servicesList = document.getElementById('servicesList');
        if (serviceSearch && servicesList) {
            serviceSearch.addEventListener('input', () => {
                const searchTerm = serviceSearch.value.toLowerCase();
                const items = servicesList.querySelectorAll('.service-item');
                items.forEach(item => {
                    const serviceName = item.dataset.serviceName;
                    item.style.display = serviceName.includes(searchTerm) ? '' : 'none';
                });
            });
        }

        // Staff filter
        const staffPositionFilter = document.getElementById('staffPositionFilter');
        const staffList = document.getElementById('staffList');
        if (staffPositionFilter && staffList) {
            staffPositionFilter.addEventListener('change', () => {
                const position = staffPositionFilter.value.toLowerCase();
                const items = staffList.querySelectorAll('.staff-item');
                items.forEach(item => {
                    item.style.display = !position || item.dataset.position === position ? '' : 'none';
                });
            });
        }
    </script>
</body>
</html>
