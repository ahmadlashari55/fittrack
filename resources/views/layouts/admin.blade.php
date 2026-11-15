<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitTrack - @yield('title', 'Dashboard')</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #4f46e5; /* Indigo */
            --secondary-color: #10b981; /* Emerald */
            --sidebar-bg: #1e1e2d;
            --body-bg: #f3f6f9;
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--body-bg); 
            overflow-x: hidden;
        }
        .wrapper { display: flex; min-height: 100vh; }
        
        /* Modern Sidebar */
        .sidebar { 
            width: 260px; 
            background: var(--sidebar-bg); 
            color: #a1a5b7; 
            transition: all 0.3s ease;
            position: fixed;
            height: 100vh;
            z-index: 1000;
        }
        .sidebar .brand { 
            font-size: 1.5rem; 
            font-weight: 700; 
            padding: 20px; 
            color: white;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar a { 
            color: #a1a5b7; 
            text-decoration: none; 
            padding: 12px 20px; 
            display: flex; 
            align-items: center;
            gap: 12px;
            font-weight: 500;
            border-radius: 8px;
            margin: 4px 15px;
            transition: 0.2s;
        }
        .sidebar a:hover, .sidebar a.active { 
            background: rgba(255,255,255,0.05); 
            color: white; 
        }
        .sidebar a.active { 
            background: var(--primary-color); 
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }
        
        /* Main Content */
        .main-content { 
            flex: 1; 
            margin-left: 260px; 
            padding: 20px 30px; 
            transition: all 0.3s ease;
            width: calc(100% - 260px);
        }
        
        /* Modern Topbar */
        .topbar { 
            background: #ffffff; 
            padding: 15px 25px; 
            border-radius: 12px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.03); 
        }
        
        /* Interactive Cards */
        .card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 25px rgba(0,0,0,0.08); 
        }
        
        /* Mobile Responsive */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; width: 100%; }
        }
        
        /* Toggle Button */
        .menu-toggle { display: none; background: none; border: none; font-size: 1.5rem; color: #333; }
        @media (max-width: 991px) { .menu-toggle { display: block; } }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="brand">
            <i class="bi bi-heart-pulse text-success"></i> FitTrack
        </div>
        <div class="mt-3">
            <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
            <a href="{{ route('food-logs.index') }}" class="{{ request()->is('food-logs*') ? 'active' : '' }}">
                <i class="bi bi-egg-fried"></i> Food Log
            </a>
            <a href="{{ route('exercise-logs.index') }}" class="{{ request()->is('exercise-logs*') ? 'active' : '' }}">
                <i class="bi bi-activity"></i> Exercise Log
            </a>
            <a href="{{ route('analyzer.index') }}" class="{{ request()->is('analyzer*') ? 'active' : '' }}">
                <i class="bi bi-stars"></i> AI Analyzer
            </a>
        </div>
        
        <div class="position-absolute bottom-0 w-100 p-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 border-0" style="background: rgba(255,255,255,0.05);">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="topbar">
            <div class="d-flex align-items-center">
                <button class="menu-toggle me-3" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h5 class="m-0 fw-bold">@yield('title', 'Dashboard')</h5>
            </div>
            <div class="d-flex align-items-center bg-light px-3 py-2 rounded-pill">
                <i class="bi bi-person-circle fs-5 me-2 text-primary"></i>
                <span class="fw-medium">{{ Auth::user()->name }}</span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" style="border-radius: 12px;">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>