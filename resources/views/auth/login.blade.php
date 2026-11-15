@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-dark">Welcome Back</h2>
        <p class="text-muted">Please login to access your account.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success mb-3">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label text-muted fw-semibold">Email Address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label text-muted fw-semibold">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember & Forgot -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                <label class="form-check-label text-muted" for="remember_me">Remember me</label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none text-success small">Forgot password?</a>
            @endif
        </div>

        <button type="submit" class="btn-primary-custom">Log In</button>
        
        <div class="text-center mt-4">
            <span class="text-muted">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-decoration-none text-success fw-bold ms-1">Register</a>
        </div>
    </form>
@endsection