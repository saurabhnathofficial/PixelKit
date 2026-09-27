@extends('layouts.app')

@section('title', 'Admin Dashboard - PixelKit')

@section('content')

<div class="container py-5">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-5">

        <div>
            <span class="pk-mini-label">
                ADMIN PANEL
            </span>

            <h1 class="fw-bold mt-2 mb-1">
                Admin Dashboard
            </h1>

            <p class="text-muted mb-0">
                Manage users and monitor PixelKit activity.
            </p>
        </div>

        <a
            href="{{ route('dashboard') }}"
            class="btn btn-outline-primary"
        >
            User Dashboard
        </a>

    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-5">

        {{-- Users --}}
        <div class="col-md-6 col-lg-3">

            <div class="compress-card h-100">

                <span class="text-muted small">
                    TOTAL USERS
                </span>

                <h2 class="fw-bold mt-2 mb-0">
                    {{ $totalUsers }}
                </h2>

                <small class="text-muted">
                    Registered users
                </small>

            </div>

        </div>


        {{-- Operations --}}
        <div class="col-md-6 col-lg-3">

            <div class="compress-card h-100">

                <span class="text-muted small">
                    TOTAL OPERATIONS
                </span>

                <h2 class="fw-bold mt-2 mb-0">
                    {{ $totalOperations }}
                </h2>

                <small class="text-muted">
                    All image operations
                </small>

            </div>

        </div>


        {{-- Compress --}}
        <div class="col-md-6 col-lg-3">

            <div class="compress-card h-100">

                <span class="text-muted small">
                    COMPRESSED
                </span>

                <h2 class="fw-bold mt-2 mb-0">
                    {{ $totalCompressed }}
                </h2>

                <small class="text-muted">
                    Compression operations
                </small>

            </div>

        </div>


        {{-- Resize / Convert --}}
        <div class="col-md-6 col-lg-3">

            <div class="compress-card h-100">

                <span class="text-muted small">
                    RESIZE / CONVERT
                </span>

                <h2 class="fw-bold mt-2 mb-0">
                    {{ $totalResized + $totalConverted }}
                </h2>

                <small class="text-muted">
                    Other operations
                </small>

            </div>

        </div>

    </div>


    {{-- Operation Breakdown --}}
    <div class="row g-4 mb-5">

        <div class="col-lg-6">

            <div class="compress-card h-100">

                <h4 class="fw-bold mb-4">
                    Operation Breakdown
                </h4>

                <div class="d-flex justify-content-between border-bottom py-3">
                    <span>Compress</span>
                    <strong>{{ $totalCompressed }}</strong>
                </div>

                <div class="d-flex justify-content-between border-bottom py-3">
                    <span>Resize</span>
                    <strong>{{ $totalResized }}</strong>
                </div>

                <div class="d-flex justify-content-between py-3">
                    <span>Convert</span>
                    <strong>{{ $totalConverted }}</strong>
                </div>

            </div>

        </div>


        {{-- Recent Users --}}
        <div class="col-lg-6">

            <div class="compress-card h-100">

                <h4 class="fw-bold mb-4">
                    Recent Users
                </h4>

                @forelse($recentUsers as $user)

                    <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                        <div>
                            <strong>
                                {{ $user->name }}
                            </strong>

                            <div class="text-muted small">
                                {{ $user->email }}
                            </div>
                        </div>

                        <small class="text-muted">
                            {{ $user->created_at->format('d M Y') }}
                        </small>

                    </div>

                @empty

                    <p class="text-muted mb-0">
                        No users found.
                    </p>

                @endforelse

            </div>

        </div>

    </div>


    {{-- Recent Operations --}}
    <div class="compress-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Recent Operations
                </h4>

                <p class="text-muted mb-0">
                    Latest image processing activity.
                </p>
            </div>

        </div>


        <div class="table-responsive">

            <table class="table align-middle">

                <thead>

                    <tr>

                        <th>User</th>

                        <th>Image</th>

                        <th>Operation</th>

                        <th>Original</th>

                        <th>Output</th>

                        <th>Date</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentOperations as $operation)

                        <tr>

                            <td>
                                @if($operation->user)
                                    <strong>
                                        {{ $operation->user->name }}
                                    </strong>

                                    <div class="text-muted small">
                                        {{ $operation->user->email }}
                                    </div>
                                @else
                                    <span class="text-muted">
                                        Unknown
                                    </span>
                                @endif
                            </td>

                            <td>
                                {{ $operation->original_filename }}
                            </td>

                            <td>

                                @if($operation->operation === 'compress')

                                    <span class="badge bg-primary">
                                        Compress
                                    </span>

                                @elseif($operation->operation === 'resize')

                                    <span class="badge bg-success">
                                        Resize
                                    </span>

                                @elseif($operation->operation === 'convert')

                                    <span class="badge bg-warning text-dark">
                                        Convert
                                    </span>

                                @else

                                    <span class="badge bg-secondary">
                                        {{ ucfirst($operation->operation) }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ number_format($operation->original_size / 1024, 2) }}
                                KB
                            </td>

                            <td>
                                {{ number_format($operation->optimized_size / 1024, 2) }}
                                KB
                            </td>

                            <td>
                                {{ $operation->created_at->format('d M Y H:i') }}
                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center text-muted py-4">
                                No operations found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection