<!DOCTYPE html>
<html>
<head>
    <title>Reports & Analytics</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Reports & Analytics - {{ date('Y-m-d') }}</h1>
    <h2>Appointment Statistics ({{ $period }})</h2>
    <p>Total Appointments: {{ $stats }}</p>

    <h2>Top Services</h2>
    <table>
        <tr><th>Service</th><th>Count</th></tr>
        @foreach ($top_services as $service)
            <tr><td>{{ $service['name'] }}</td><td>{{ $service['count'] }}</td></tr>
        @endforeach
    </table>

    <h2>Top Staff</h2>
    <table>
        <tr><th>Staff</th><th>Count</th></tr>
        @foreach ($top_staff as $staff)
            <tr><td>{{ $staff['name'] }}</td><td>{{ $staff['count'] }}</td></tr>
        @endforeach
    </table>
</body>
</html>