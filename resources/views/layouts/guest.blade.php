<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitTrack - @yield('title', 'Auth')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; height: 100vh; margin: 0; overflow: hidden; background-color: #f8f9fa; }
        .auth-wrapper { display: flex; height: 100vh; }
        
        /* Left Side - Branding */
        .auth-left {
            flex: 1;
            background: linear-gradient(135deg, #111827 0%, #10b981 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            text-align: center;
        }
        .auth-left h1 { font-weight: 700; font-size: 3rem; margin-bottom: 10px; }
        .auth-left p { font-size: 1.1rem; opacity: 0.8; max-width: 400px; }
        .auth-icon { font-size: 5rem; color: #10b981; margin-bottom: 20px; }
        
        /* Right Side - Form */
        .auth-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            background: #ffffff;
        }
        .auth-form-container { width: 100%; max-width: 400px; }
        
        /* Form Inputs */
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }
        .form-control:focus { border-color: #10b981; box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25); background-color: #fff; }
        .btn-primary-custom {
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: 0.3s;
        }
        .btn-primary-custom:hover { background-color: #059669; transform: translateY(-2px); }
        
        /* Responsive */
        @media (max-width: 768px) {
            .auth-left { display: none; }
        }
    </style>
</head>
<body>

    <div class="auth-wrapper">
        <!-- Left Side Branding -->
        <div class="auth-left">
            <i class="bi bi-heart-pulse auth-icon"></i>
            <h1>FitTrack</h1>
            <p>Your personal health and fitness companion. Track your food, exercises, and achieve your goals.</p>
        </div>

        <!-- Right Side Form -->
        <div class="auth-right">
            <div class="auth-form-container">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>