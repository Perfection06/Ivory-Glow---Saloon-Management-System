<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reports & Analytics - Ivory Glow</title>
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

        .section {
            padding: 3rem 1rem;
            min-height: calc(100vh - 80px);
        }

        h2 {
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

        .report-card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .report-card:hover {
            transform: translateY(-3px);
        }

        .report-card h5 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .report-card p {
            font-size: 0.95rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .report-table {
            background: var(--glass-bg);
            border-radius: 8px;
            overflow: hidden;
        }

        .report-table th {
            background: var(--table-header-bg);
            color: #ffffff;
            font-weight: 500;
            padding: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .report-table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-color: rgba(0, 0, 0, 0.1);
        }

        .report-table tbody tr:hover {
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

        .btn-secondary {
            background-color: var(--secondary-accent);
            border-color: var(--secondary-accent);
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-secondary:hover {
            background-color: #5c636a;
            border-color: #5c636a;
            transform: scale(1.05);
        }

        .btn-success {
            background-color: var(--secondary-accent);
            border-color: var(--secondary-accent);
            color: #ffffff;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-success:hover {
            background-color: #5c636a;
            border-color: #5c636a;
            transform: scale(1.05);
        }

        .form-select, .form-control {
            border-color: rgba(0, 0, 0, 0.1);
            background: rgba(255, 255, 255, 0.9);
            color: var(--text-color);
        }

        .form-select:focus, .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 5px rgba(52, 58, 64, 0.3);
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: none;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .modal-content {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        .modal-header, .modal-footer {
            border-color: rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .section {
                padding: 2rem 1rem;
            }

            h2 {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.75rem;
            }

            .report-card {
                padding: 1rem;
            }

            .report-card h5 {
                font-size: 1.25rem;
            }

            .report-card p, .report-table td, .report-table th {
                font-size: 0.85rem;
            }

            .report-table th, .report-table td {
                padding: 0.5rem;
            }

            .form-select, .form-control {
                font-size: 0.85rem;
            }

            .btn-primary, .btn-secondary, .btn-success {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
        }

        /* Print Styles */
        @media print {
            .no-print, .sidebar {
                display: none !important;
            }
            body {
                background: white;
                margin: 0;
                padding: 0;
            }
            .main-content {
                margin-left: 0;
                padding: 1cm;
            }
            .section {
                padding: 0;
                min-height: auto;
            }
            .glass, .report-card, .modal-content {
                border: none;
                box-shadow: none;
                background: white;
                padding: 0;
            }
            .report-table {
                background: white;
                width: 100%;
            }
            .report-table th, .report-table td {
                border: 1px solid #000;
                padding: 0.5cm;
                font-size: 10pt;
            }
            h2 {
                font-size: 14pt;
                text-align: center;
                margin-bottom: 1cm;
            }
            .report-card h5 {
                font-size: 12pt;
                margin-bottom: 0.5cm;
            }
            .report-card p {
                font-size: 10pt;
            }
            .container {
                width: 100%;
                max-width: none;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <section class="section">
            <div class="container">
                <h2 class="text-center mb-5">Reports & Analytics</h2>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="glass">
                    <!-- Filters -->
                    <div class="report-card no-print">
                        <h5>Filters</h5>
                        <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3">
                            <div class="col-md-3 col-sm-6">
                                <select name="period" class="form-select" onchange="this.form.submit()">
                                    <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Daily</option>
                                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <select name="staff_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">All Staff</option>
                                    @foreach ($staff as $s)
                                        <option value="{{ $s->id }}" {{ request('staff_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <select name="service_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">All Services</option>
                                    @foreach ($services as $s)
                                        <option value="{{ $s->id }}" {{ request('service_id') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <input type="date" name="date" class="form-control" value="{{ request('date') }}" onchange="this.form.submit()">
                            </div>
                        </form>
                    </div>

                    <!-- Appointment Stats -->
                    <div class="report-card">
                        <h5>Appointment Statistics ({{ request('period', 'daily') }})</h5>
                        <p>Total Appointments: {{ $stats }}</p>
                    </div>

                    <!-- Top Services -->
                    <div class="report-card">
                        <h5>Top 5 Services</h5>
                        @if ($topServices->isNotEmpty())
                            <div class="table-responsive">
                                <table class="report-table table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Service Name</th>
                                            <th>Appointments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topServices as $service)
                                            <tr>
                                                <td>{{ $service->name }}</td>
                                                <td>{{ $service->count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No data available.</p>
                        @endif
                    </div>

                    <!-- Top Staff -->
                    <div class="report-card">
                        <h5>Top 5 Staff</h5>
                        @if ($topStaff->isNotEmpty())
                            <div class="table-responsive">
                                <table class="report-table table table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>Staff Name</th>
                                            <th>Appointments</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topStaff as $staffMember)
                                            <tr>
                                                <td>{{ $staffMember->name }}</td>
                                                <td>{{ $staffMember->count }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>No data available.</p>
                        @endif
                    </div>

                    <!-- Export Options -->
                    <div class="report-card no-print">
                        <h5>Export Options</h5>
                        <a href="{{ route('admin.reports.export', ['format' => 'csv'] + request()->query()) }}" class="btn btn-primary me-2">Export to CSV</a>
                        <button type="button" class="btn btn-primary" onclick="openPdfModal()">Export to PDF</button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Filtered Report for PDF Export</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reportContent">
                    <div class="glass p-4">
                        <!-- Appointment Stats -->
                        <div class="report-card">
                            <h5>Appointment Statistics ({{ request('period', 'daily') }})</h5>
                            <p>Total Appointments: {{ $stats }}</p>
                        </div>

                        <!-- Top Services -->
                        <div class="report-card">
                            <h5>Top 5 Services</h5>
                            @if ($topServices->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="report-table table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Service Name</th>
                                                <th>Appointments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topServices as $service)
                                                <tr>
                                                    <td>{{ $service->name }}</td>
                                                    <td>{{ $service->count }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No data available.</p>
                            @endif
                        </div>

                        <!-- Top Staff -->
                        <div class="report-card">
                            <h5>Top 5 Staff</h5>
                            @if ($topStaff->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="report-table table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>Staff Name</th>
                                                <th>Appointments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($topStaff as $staffMember)
                                                <tr>
                                                    <td>{{ $staffMember->name }}</td>
                                                    <td>{{ $staffMember->count }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>No data available.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="printReport()">Print</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
    <script>
        function openPdfModal() {
            const modal = new bootstrap.Modal(document.getElementById('pdfModal'));
            modal.show();
            document.querySelector('.btn-success').focus();
        }

        function printReport() {
            try {
                // Generate PDF
                const { jsPDF } = window.jspdf;
                const doc = new jsPDF();

                // Set font and styles
                doc.setFont("helvetica", "normal");
                doc.setFontSize(12);

                // Header
                doc.setFontSize(18);
                doc.text("Ivory Glow Report", 20, 20);
                doc.setFontSize(12);
                doc.text("Ivory Glow Beauty Services", 20, 30);
                doc.text("123 Main St, Colombo, Sri Lanka", 20, 35);
                doc.text("Phone: +94 11 123 4567", 20, 40);

                // Report Details
                const content = document.getElementById('reportContent');
                if (!content) {
                    console.error('Report content not found');
                    return;
                }

                const period = "{{ request('period', 'daily') }}";
                const stats = content.querySelector("p")?.textContent.replace("Total Appointments: ", "") || "N/A";
                doc.text(`Period: ${period}`, 20, 50);
                doc.text(`Total Appointments: ${stats}`, 20, 60);

                // Top Services Table
                const servicesTable = content.querySelectorAll("table")[0];
                let startY = 70;
                if (servicesTable) {
                    doc.autoTable({
                        startY: startY,
                        html: servicesTable,
                        theme: 'striped',
                        headStyles: { fillColor: [139, 90, 43], textColor: [255, 255, 255] },
                        bodyStyles: { textColor: [60, 47, 47] },
                        margin: { left: 20, right: 20 },
                    });
                } else {
                    doc.text("No services data available.", 20, startY);
                }

                // Top Staff Table
                const staffTable = content.querySelectorAll("table")[1];
                startY = doc.lastAutoTable ? doc.lastAutoTable.finalY + 10 : 80;
                if (staffTable) {
                    doc.autoTable({
                        startY: startY,
                        html: staffTable,
                        theme: 'striped',
                        headStyles: { fillColor: [139, 90, 43], textColor: [255, 255, 255] },
                        bodyStyles: { textColor: [60, 47, 47] },
                        margin: { left: 20, right: 20 },
                    });
                } else {
                    doc.text("No staff data available.", 20, startY);
                }

                // Footer
                const finalY = doc.lastAutoTable ? doc.lastAutoTable.finalY + 10 : 90;
                doc.setFontSize(10);
                doc.text("Thank you for choosing Ivory Glow!", 20, finalY);
                doc.text("For inquiries, contact us at info@Ivory Glow.com", 20, finalY + 5);

                // Save PDF
                doc.save(`Ivory Glow_report_${new Date().toISOString().replace(/T/, '_').replace(/:/g, '').slice(0, 15)}.pdf`);

                // Trigger Print
                window.print();
                window.onafterprint = function() {
                    bootstrap.Modal.getInstance(document.getElementById('pdfModal')).hide();
                };
            } catch (error) {
                console.error('Error generating PDF:', error);
            }
        }
    </script>
</body>
</html>