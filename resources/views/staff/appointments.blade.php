<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Management - Ivory Glow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #ffffff;
            color: #343a40;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }
        .main-content {
            margin-left: 270px;
            padding: 20px;
            margin-top: -100px;
        }
        .section {
            min-height: 100vh;
            padding: 80px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .glass {
            background: #ffffff;
            border: 1px solid #ced4da;
            border-radius: 15px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .table {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background: #343a40;
            color: #ffffff;
            font-weight: 600;
        }
        .table td {
            color: #343a40;
        }
        .table tbody tr:hover {
            background: rgba(52, 58, 64, 0.05);
        }
        .alert {
            border-radius: 10px;
        }
        .btn-status, .btn-cancel, .btn-products, .btn-invoice {
            border-radius: 8px;
            font-size: 0.9rem;
            padding: 5px 10px;
        }
        .btn-status {
            background: #007bff;
            color: #ffffff;
        }
        .btn-status:hover {
            background: #0056b3;
        }
        .btn-cancel {
            background: #dc3545;
            color: #ffffff;
        }
        .btn-cancel:hover {
            background: #c82333;
        }
        .btn-products {
            background: #6f42c1;
            color: #ffffff;
        }
        .btn-products:hover {
            background: #5a32a3;
        }
        .btn-invoice {
            background: #28a745;
            color: #ffffff;
        }
        .btn-invoice:hover {
            background: #218838;
        }
        footer {
            background: #343a40;
            padding: 20px;
            font-size: 0.9rem;
            color: white;
        }
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
            .section {
                min-height: auto;
                padding: 40px 15px;
            }
        }
    </style>
        </head>
            <body>
            @include('staff.sidebar')
            <div class="main-content">
            <section class="section">
            <div class="container">
            <h2 class="text-center mb-5" style="font-family: 'Playfair Display', serif;">Appointment Management</h2>
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

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->customer->name }}</td>
                                    <td>{{ $appointment->service->name }}</td>
                                    <td>{{ $appointment->appointment_date->format('Y-m-d') }}</td>
                                    <td>{{ $appointment->appointment_time }}</td>
                                    <td>{{ ucfirst($appointment->status) }}</td>
                                    <td>
                                        @if (in_array($appointment->status, ['pending', 'confirmed']))
                                            <form action="{{ route('staff.appointments.update', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()">
                                                    <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="confirmed" {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>Approved</option>
                                                    <option value="completed">Completed</option>
                                                </select>
                                            </form>
                                            <form action="{{ route('staff.appointments.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-cancel">Cancel</button>
                                            </form>
                                        @endif
                                        @if ($appointment->status == 'confirmed')
                                            <button type="button" class="btn btn-products" data-bs-toggle="modal" data-bs-target="#productsModal{{ $appointment->id }}">Products</button>
                                        @endif
                                        @if ($appointment->status == 'completed' && $appointment->invoice)
                                            <button type="button" class="btn btn-invoice" data-bs-toggle="modal" data-bs-target="#invoiceModal{{ $appointment->id }}">Invoice</button>
                                        @endif
                                        <!-- Product Selection Modal -->
                                        @if ($appointment->status == 'confirmed')
                                            <div class="modal fade" id="productsModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="productsModalLabel{{ $appointment->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="productsModalLabel{{ $appointment->id }}">Select Products for {{ $appointment->service->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('staff.appointments.products', $appointment->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-body">
                                                                @if ($products->isEmpty())
                                                                    <p>No products available for your position.</p>
                                                                @else
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Unit Price (Rs.)</th>
                                                                                <th>Available</th>
                                                                                <th>Quantity</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($products as $product)
                                                                                <tr>
                                                                                    <td>{{ $product->name }}</td>
                                                                                    <td>Rs. {{ number_format($product->unit_price, 2) }}</td>
                                                                                    <td>{{ $product->quantity }}</td>
                                                                                    <td>
                                                                                        <input type="number" name="products[{{ $product->id }}]" min="0" max="{{ $product->quantity }}" value="0" class="form-control">
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                @unless ($products->isEmpty())
                                                                    <button type="submit" class="btn btn-primary">OK</button>
                                                                @endunless
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        <!-- Invoice Modal -->
                                        @if ($appointment->status == 'completed' && $appointment->invoice)
                                            <div class="modal fade" id="invoiceModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="invoiceModalLabel{{ $appointment->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="invoiceModalLabel{{ $appointment->id }}">Invoice for {{ $appointment->service->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="invoiceContent{{ $appointment->id }}">
                                                            <h5>Ivory Glow Invoice</h5>
                                                            <p><strong>Customer Name:</strong> {{ $appointment->customer->name }}</p>
                                                            <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
                                                            <p><strong>Service Price:</strong> Rs. {{ number_format($appointment->invoice->service_price, 2) }}</p>
                                                            <p><strong>Date:</strong> {{ $appointment->appointment_date->format('Y-m-d') }}</p>
                                                            <p><strong>Time:</strong> {{ $appointment->appointment_time }}</p>
                                                            <p><strong>Staff:</strong> {{ $appointment->staff->name ?? 'Not Assigned' }} ({{ $appointment->staff->position ?? 'N/A' }})</p>
                                                            <h6>Used Products:</h6>
                                                            @if ($appointment->invoice->staffProducts->isEmpty())
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
                                                                        @foreach ($appointment->invoice->staffProducts as $staffProduct)
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
                                                            <button type="button" class="btn btn-primary" onclick="printInvoice({{ $appointment->id }})">Print</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No appointments assigned.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script>
        function printInvoice(appointmentId) {
            console.log('printInvoice called with appointmentId:', appointmentId); // Debug
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
                const content = document.getElementById(`invoiceContent${appointmentId}`);
                if (!content) {
                    console.error('Modal content not found for ID: invoiceContent' + appointmentId);
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
                doc.save(`invoice_${appointmentId}.pdf`);
            } catch (error) {
                console.error('Error generating PDF:', error);
            }
        }
    </script>
</body>
</html>