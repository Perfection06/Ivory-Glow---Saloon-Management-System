<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ivory Glow - Admin Messages</title>
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

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        .table {
            background: var(--glass-bg);
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            max-width: 100%;
            table-layout: auto;
        }

        .table th {
            background: var(--table-header-bg);
            color: #ffffff;
            font-weight: 600;
            padding: 15px;
            white-space: nowrap;
        }

        .table td {
            color: var(--text-color);
            padding: 15px;
            vertical-align: middle;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .table tr:hover {
            background: rgba(0, 0, 0, 0.05);
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
            .table th, .table td {
                font-size: 0.85rem;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    @include('admin.sidebar')

    <div class="main-content">
        <div class="glass">
            <h2>Messages</h2>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($messages->isEmpty())
                <p>No messages available.</p>
            @else
                <div class="table-container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Received</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{ $message->name }}</td>
                                    <td>{{ $message->email }}</td>
                                    <td>{{ $message->phone ?? 'N/A' }}</td>
                                    <td>{{ Str::limit($message->message, 50) }}</td>
                                    <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>