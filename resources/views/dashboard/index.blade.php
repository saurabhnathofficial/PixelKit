@extends('layouts.app')

@section('title', 'Dashboard - PixelKit')

@section('content')

<div class="container py-5">

    <div class="mb-5">
        <span class="pk-mini-label">
            PIXELKIT DASHBOARD
        </span>

        <h1 class="fw-bold mt-2">
            Image Processing History
        </h1>

        <p class="text-muted">
            View your recent image optimization operations.
        </p>
    </div>


    {{-- STATISTICS --}}

    <div class="row g-4 mb-5">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <small class="text-muted">
                    Total Operations
                </small>

                <h2 class="fw-bold mt-2">
                    {{ $totalOperations }}
                </h2>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <small class="text-muted">
                    Compressed
                </small>

                <h2 class="fw-bold mt-2">
                    {{ $totalCompressed }}
                </h2>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <small class="text-muted">
                    Resized
                </small>

                <h2 class="fw-bold mt-2">
                    {{ $totalResized }}
                </h2>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card border-0 shadow-sm p-4 h-100">
                <small class="text-muted">
                    Converted
                </small>

                <h2 class="fw-bold mt-2">
                    {{ $totalConverted }}
                </h2>
            </div>
        </div>

    </div>


    {{-- RECENT OPERATIONS --}}

    <div class="card border-0 shadow-sm">

        <div class="card-body p-4">

            <h4 class="fw-bold mb-4">
                Recent Operations
            </h4>

            <div class="table-responsive">

                <table class="table align-middle">

                    <thead>

                        <tr>
                            <th>Image</th>
                            <th>Operation</th>
                            <th>Original Size</th>
                            <th>Output Size</th>
                            <th>Created</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentOperations as $operation)

                            <tr>

                                <td>
                                    {{ $operation->original_filename }}
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ ucfirst($operation->operation) }}
                                    </span>
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
                                    {{ $operation->created_at->format('d M Y, h:i A') }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="5"
                                    class="text-center text-muted py-5"
                                >
                                    No operations yet.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection