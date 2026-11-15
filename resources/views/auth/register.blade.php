@extends('layouts.guest')

@section('title', 'Register')

@section('content')
    <div class="mb-4 text-center">
        <h2 class="fw-bold text-dark">Create an Account</h2>
        <p class="text-muted">Start your fitness journey today.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label text-muted fw-semibold">Full Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="form-label text-muted fw-semibold">Email Address</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
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

        <!-- Confirm Password -->
        <div class="mb-4">
            <label class="form-label text-muted fw-semibold">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn-primary-custom">Create Account</button>
        
        <div class="text-center mt-4">
            <span class="text-muted">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-decoration-none text-success fw-bold ms-1">Log In</a>
        </div>
    </form>
@endsection