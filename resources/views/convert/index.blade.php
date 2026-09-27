@extends('layouts.app')

@section('title', 'Convert Images - PixelKit')

@section('content')

<div class="container py-5">

    <div class="text-center mb-5">

        <span class="pk-mini-label">
            IMAGE CONVERTER
        </span>

        <h1 class="fw-bold mt-2">
            Convert Images to WebP
        </h1>

        <p class="text-muted">
            Convert JPG, PNG and other supported images to WebP.
        </p>

    </div>


    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="compress-card">

                <form
                    action="{{ route('images.convert') }}"
                    method="POST"
                    enctype="multipart/form-data"
                >

                    @csrf

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Select Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            accept="image/jpeg,image/png,image/webp"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="compress-submit"
                    >
                        Convert to WebP
                    </button>

                </form>

            </div>


            @if(session('convert_result'))

                @php
                    $result = session('convert_result');
                @endphp

                <div class="result-card mt-5">

                    <h4>
                        Conversion Complete! ✓
                    </h4>

                    <p>
                        {{ $result['original_filename'] }}
                    </p>

                    <div class="result-stats">

                        <div>
                            <span>Original</span>

                            <strong>
                                {{ number_format($result['original_size'] / 1024, 2) }}
                                KB
                            </strong>
                        </div>

                        <div class="result-arrow">
                            →
                        </div>

                        <div>
                            <span>WebP</span>

                            <strong>
                                {{ number_format($result['optimized_size'] / 1024, 2) }}
                                KB
                            </strong>
                        </div>

                    </div>

                    <a
                        href="{{ route('images.download', [
                            'filename' => $result['optimized_filename']
                        ]) }}"
                        class="pk-btn pk-btn-primary"
                    >
                        ↓ Download WebP
                    </a>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection