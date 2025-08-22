<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ivory Glow - My Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f5f5, #e0d8c3);
            color: #3c2f2f;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        .glass {
            background: rgba(245, 245, 245, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            padding: 20px;
            background: rgba(139, 90, 43, 0.9);
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: #f5f5f5;
            font-weight: 600;
            margin: 10px 0;
            padding: 12px;
            border-radius: 10px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        .sidebar .nav-link.active {
            background: rgba(245, 245, 245, 0.3);
            color: #3c2f2f;
        }
        .sidebar .nav-link:hover {
            background: rgba(245, 245, 245, 0.2);
            color: #f5f5f5;
        }
        .sidebar .btn {
            border-radius: 10px;
            font-weight: 600;
            background: #f5f5f5;
            color: #3c2f2f;
            border: none;
        }
        .sidebar .btn:hover {
            background: #e0d8c3;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
        }
        .section {
            min-height: 100vh;
            padding: 80px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .customer-details {
            background: rgba(245, 245, 245, 0.9);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .customer-details p {
            margin: 0 0 10px;
            font-size: 1rem;
        }
        .customer-details p strong {
            color: #8b5a2b;
        }
        .table {
            background: rgba(245, 245, 245, 0.9);
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #8b5a2b;
            color: #f5f5f5;
            font-weight: 600;
        }
        .table td {
            color: #3c2f2f;
        }
        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.3);
        }
        .alert {
            border-radius: 10px;
        }
        .btn-cancel, .btn-invoice {
            border-radius: 8px;
            font-size: 0.9rem;
            padding: 5px 10px;
        }
        .btn-cancel {
            background: #dc3545;
            color: #f5f5f5;
        }
        .btn-cancel:hover {
            background: #c82333;
        }
        .btn-invoice {
            background: #28a745;
            color: #f5f5f5;
        }
        .btn-invoice:hover {
            background: #218838;
        }
        footer {
            background: #8b5a2b;
            padding: 20px;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 10px;
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar .nav {
                flex-direction: row;
                justify-content: center;
                gap: 10px;
            }
            .sidebar .nav-link {
                margin: 5px;
                padding: 8px;
                font-size: 0.9rem;
            }
            .section {
                min-height: auto;
                padding: 40px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar glass">
        <h4 class="text-white text-center mb-4" style="font-family: 'Playfair Display', serif;">Ivory Glow</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#about">About Us</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#services">Services</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#staff">Our Team</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#contact">Contact Us</a></li>
            <li class="nav-item mt-3"><a href="{{ route('settings') }}" class="btn btn-outline-light w-100 active">My Settings</a></li>
            <li class="nav-item mt-2">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="container">
                <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif;">My Settings</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="customer-details glass">
                    <h4>Customer Details</h4>
                    <p><strong>Name:</strong> {{ Auth::guard('web')->user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::guard('web')->user()->email }}</p>
                    <p><strong>Phone:</strong> {{ Auth::guard('web')->user()->phone_number ?? 'Not provided' }}</p>
                </div>
                <h4 class="mb-3">My Bookings</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Staff</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->service->name }}</td>
                                    <td>{{ $booking->staff ? $booking->staff->name . ' (' . $booking->staff->position . ')' : 'No Staff Assigned' }}</td>
                                    <td>{{ $booking->appointment_date->format('Y-m-d') }}</td>
                                    <td>{{ $booking->appointment_time }}</td>
                                    <td>{{ ucfirst($booking->status) }}</td>
                                    <td>
                                        @if (in_array($booking->status, ['pending', 'confirmed']))
                                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-cancel">Cancel</button>
                                            </form>
                                        @endif
                                        @if ($booking->status == 'completed' && $booking->invoice)
                                            <button type="button" class="btn btn-invoice" data-bs-toggle="modal" data-bs-target="#invoiceModal{{ $booking->id }}">Invoice</button>
                                        @endif
                                        <!-- Invoice Modal -->
                                        @if ($booking->status == 'completed' && $booking->invoice)
                                            <div class="modal fade" id="invoiceModal{{ $booking->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel{{ $booking->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="invoiceModalLabel{{ $booking->id }}">Invoice for {{ $booking->service->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="invoiceContent{{ $booking->id }}">
                                                            <h5>Ivory Glow Invoice</h5>
                                                            <p><strong>Customer Name:</strong> {{ $booking->customer->name }}</p>
                                                            <p><strong>Service:</strong> {{ $booking->service->name }}</p>
                                                            <p><strong>Service Price:</strong> Rs. {{ number_format($booking->invoice->service_price, 2) }}</p>
                                                            <p><strong>Date:</strong> {{ $booking->appointment_date->format('Y-m-d') }}</p>
                                                            <p><strong>Time:</strong> {{ $booking->appointment_time }}</p>
                                                            <p><strong>Staff:</strong> {{ $booking->staff->name ?? 'Not Assigned' }} ({{ $booking->staff->position ?? 'N/A' }})</p>
                                                            <h6>Used Products:</h6>
                                                            @if ($booking->invoice->staffProducts->isEmpty())
                                                                <p>No products used.</p>
                                                            @else
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Product Name</th>
                                                                            <th>Quantity</th>
                                                                            <th>Unit Price</th>
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($booking->invoice->staffProducts as $staffProduct)
                                                                            <tr>
                                                                                <td>{{ $staffProduct->product->name }}</td>
                                                                                <td>{{ $staffProduct->quantity }}</td>
                                                                                <td>Rs. {{ number_format($staffProduct->product->unit_price, 2) }}</td>
                                                                                <td>Rs. {{ number_format($staffProduct->total_price, 2) }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" onclick="printInvoice({{ $booking->id }})">Print</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No bookings found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="text-center text-white">
        <div class="glass p-3">
            <p>© {{ date('Y') }} Ivory Glow. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script>
        function printInvoice(bookingId) {
            console.log('printInvoice called with bookingId:', bookingId); // Debug
            try {
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Set font and styles
                doc.setFont("helvetica", "normal");
                doc.setFontSize(12);

                // Header
                doc.setFontSize(18);
                doc.text("Ivory Glow Invoice", 20, 20);
                doc.setFontSize(12);
                doc.text("Ivory Glow Beauty Services", 20, 30);
                doc.text("123 Main St, Colombo, Sri Lanka", 20, 35);
                doc.text("Phone: +94 11 123 4567", 20, 40);

                // Invoice Details
                const content = document.getElementById(`invoiceContent${bookingId}`);
                if (!content) {
                    console.error('Modal content not found for ID: invoiceContent' + bookingId);
                    return;
                }

                const customerName = content.querySelector("p:nth-child(1)")?.textContent.replace("Customer Name: ", "") || "N/A";
                const service = content.querySelector("p:nth-child(2)")?.textContent.replace("Service: ", "") || "N/A";
                const servicePrice = content.querySelector("p:nth-child(3)")?.textContent.replace("Service Price: ", "") || "N/A";
                const date = content.querySelector("p:nth-child(4)")?.textContent.replace("Date: ", "") || "N/A";
                const time = content.querySelector("p:nth-child(5)")?.textContent.replace("Time: ", "") || "N/A";
                const staff = content.querySelector("p:nth-child(6)")?.textContent.replace("Staff: ", "") || "N/A";

                doc.text(`Customer: ${customerName}`, 20, 50);
                doc.text(`Service: ${service}`, 20, 60);
                doc.text(`Service Price: ${servicePrice}`, 20, 70);
                doc.text(`Date: ${date}`, 20, 80);
                doc.text(`Time: ${time}`, 20, 90);
                doc.text(`Staff: ${staff}`, 20, 100);

                // Products Table
                const table = content.querySelector("table");
                if (table) {
                    doc.autoTable({
                        startY: 110,
                        html: table,
                        theme: 'striped',
                        headStyles: { fillColor: [139, 90, 43], textColor: [255, 255, 255] },
                        bodyStyles: { textColor: [60, 47, 47] },
                        margin: { left: 20, right: 20 },
                    });
                } else {
                    doc.text("No products used.", 20, 110);
                }

                // Footer
                const finalY = doc.lastAutoTable ? doc.lastAutoTable.finalY + 10 : 120;
                doc.setFontSize(10);
                doc.text("Thank you for choosing Ivory Glow!", 20, finalY);
                doc.text("For inquiries, contact us at info@Ivory Glow.com", 20, finalY + 5);

                // Save PDF
                doc.save(`invoice_${bookingId}.pdf`);
            } catch (error) {
                console.error('Error generating PDF:', error);
            }
        }
    </script>
</body>
</html>