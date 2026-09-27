@extends('layouts.app')

@section('title', 'Create Account - PixelKit')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="text-center mb-4">

                <span class="pk-mini-label">
                    PIXELKIT ACCOUNT
                </span>

                <h1 class="fw-bold mt-2">
                    Create Your Account
                </h1>

                <p class="text-muted">
                    Start optimizing and keep track of your image history.
                </p>

            </div>

            <div class="compress-card">

                <form action="{{ route('register.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            placeholder="Your name"
                            required
                        >

                        @error('name')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

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

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Password
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            placeholder="Minimum 8 characters"
                            required
                        >

                        @error('password')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Confirm Password
                        </label>

                        <input
                            type="password"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Confirm your password"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="compress-submit"
                    >
                        Create Account
                    </button>

                </form>

                <div class="text-center mt-4">

                    <span class="text-muted">
                        Already have an account?
                    </span>

                    <a href="{{ route('login') }}"
                       class="text-decoration-none fw-semibold">
                        Login
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection