@extends('layouts.app')

@section('title', 'Login - PixelKit')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="text-center mb-4">

                <span class="pk-mini-label">
                    PIXELKIT ACCOUNT
                </span>

                <h1 class="fw-bold mt-2">
                    Welcome Back
                </h1>

                <p class="text-muted">
                    Login to access your image processing history.
                </p>

            </div>

            <div class="compress-card">

                <form action="{{ route('login.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                        >

                        @error('email')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter your password"
                            required
                        >

                        @error('password')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <button
                        type="submit"
                        class="compress-submit"
                    >
                        Login
                    </button>

                </form>

                <div class="text-center mt-4">

                    <span class="text-muted">
                        Don't have an account?
                    </span>

                    <a href="{{ route('register') }}"
                       class="text-decoration-none fw-semibold">
                        Create Account
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection