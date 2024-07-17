<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Factures</title>
</head>
<body>
    
<div class="container">
        @if (session('flash_message'))
            <div class="alert alert-success mt-4">
                {{ session('flash_message') }}
            </div>
        @endif
        @yield('content')
    </div>
    
</body>
</html>