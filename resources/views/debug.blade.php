<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debugging View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Debugging Data</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Email</td>
                    <td>{{ $email; }}</td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>{{ $password; }}</td>
                </tr>
                <tr>
                    <td>db</td>
                    <td>{{ $db; }}</td>
                </tr>
            </tbody>
        </table>

        <h3>Data dalam format JSON</h3>
        <pre>{{ json_encode(['email' => $email, 'password' => $password], JSON_PRETTY_PRINT); }}</pre>
        <h3>penyewa</h3>
        <pre>{{ json_encode(['penyewa' => $penyewa], JSON_PRETTY_PRINT); }}</pre>
        
        <!-- Menampilkan data ke dalam console menggunakan JavaScript -->
        <script>
            var email = "{{ $email; }}";
            var password = "{{ $password; }}";

            // Debugging dengan console.log
            console.log("Email yang diterima: " + email);
            console.log("Password yang diterima: " + password);
        </script>
    </div>
</body>
</html>
