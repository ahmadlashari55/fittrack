<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitTrack - Your Personal Health Companion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f9; font-family: sans-serif; }
        .hero { height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; }
        .hero-icon { font-size: 5rem; color: #198754; margin-bottom: 20px; }
    </style>
</head>
<body>

    <div class="container hero">
        <div>
            <i class="bi bi-heart-pulse hero-icon"></i>
            <h1 class="display-4 fw-bold mb-3">FitTrack</h1>
            <p class="lead text-muted mb-4">Track your food, exercises, and get smart health suggestions to reach your fitness goals.</p>
            
            <div class="d-flex justify-content-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-success btn-lg px-4">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-success btn-lg px-4">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg px-4">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>

</body>
</html>