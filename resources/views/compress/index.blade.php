@extends('layouts.app')

@section('title', 'Compress Images - PixelKit')

@section('content')

<section class="compress-page">

    <div class="container py-5">

        {{-- Header --}}
        <div class="text-center mb-5">

            <span class="pk-mini-label">
                IMAGE OPTIMIZER
            </span>

            <h1 class="compress-title">
                Compress Images
            </h1>

            <p class="compress-subtitle">
                Reduce image file size without losing
                noticeable quality.
            </p>

        </div>


        {{-- Upload Card --}}
        <div class="compress-card">

            <form
                action="{{ route('images.compress') }}"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                {{-- Drop Zone --}}
                <div
                    class="upload-zone"
                    id="uploadZone"
                >

                    <input
                        type="file"
                        name="image"
                        id="imageInput"
                        accept="image/jpeg,image/png,image/webp"
                        hidden
                    >


                    <div class="upload-icon">
                        ↑
                    </div>


                    <h4>
                        Drag & drop your image here
                    </h4>

                    <p>
                        or click to browse files
                    </p>


                    <button
                        type="button"
                        class="pk-btn pk-btn-primary"
                        id="chooseImage"
                    >
                        Choose Image
                    </button>


                    <small>
                        JPG, PNG or WebP · Maximum 10 MB
                    </small>

                </div>


                {{-- Preview --}}
                <div
                    id="imagePreview"
                    class="image-preview mt-4 d-none"
                >

                    <img
                        id="previewImage"
                        src=""
                        alt="Preview"
                    >

                    <div>

                        <strong id="fileName">
                        </strong>

                        <small
                            id="fileSize"
                            class="d-block text-muted"
                        >
                        </small>

                    </div>

                </div>


                {{-- Options --}}
                <div class="compress-options mt-4">

                    <div>

                        <label class="form-label fw-bold">
                            Compression Quality
                        </label>

                        <div class="d-flex align-items-center gap-3">

                            <input
                                type="range"
                                class="form-range"
                                name="quality"
                                id="quality"
                                min="10"
                                max="100"
                                value="70"
                            >

                            <span
                                id="qualityValue"
                                class="quality-value"
                            >
                                70%
                            </span>

                        </div>

                        <div class="quality-labels">

                            <span>
                                Smaller File
                            </span>

                            <span>
                                Better Quality
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Submit --}}
                <button
                    type="submit"
                    class="compress-submit"
                    id="compressButton"
                >
                    ⚡ Compress Image
                </button>

            </form>

        </div>


        {{-- Success --}}
        @if(session('success'))

            <div class="result-card mt-5">

                <div class="result-success">
                    ✓
                </div>

                <div>

                    <h4>
                        Optimization Complete!
                    </h4>

                    <p>
                        {{ session('original_name') }}
                    </p>

                </div>


                <div class="result-stats">

                    <div>
                        <span>Original</span>
                        <strong>
                            {{ session('original_size') }}
                        </strong>
                    </div>

                    <div class="result-arrow">
                        →
                    </div>

                    <div>
                        <span>Optimized</span>
                        <strong>
                            {{ session('optimized_size') }}
                        </strong>
                    </div>

                    <div class="saving-percent">
                        -{{ session('saved_percentage') }}%
                    </div>

                </div>


                <a
                    href="{{ route('images.download', ['filename' => session('download_filename')]) }}"
                    class="pk-btn pk-btn-primary"
                >
                    ↓ Download Image
                </a>

            </div>

        @endif


        {{-- Errors --}}
        @if($errors->any())

            <div class="alert alert-danger mt-4">

                <strong>
                    Please fix the following:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif

    </div>

</section>

@endsection


@push('scripts')

<script>

    const imageInput =
        document.getElementById('imageInput');

    const chooseImage =
        document.getElementById('chooseImage');

    const uploadZone =
        document.getElementById('uploadZone');

    const preview =
        document.getElementById('imagePreview');

    const previewImage =
        document.getElementById('previewImage');

    const fileName =
        document.getElementById('fileName');

    const fileSize =
        document.getElementById('fileSize');

    const quality =
        document.getElementById('quality');

    const qualityValue =
        document.getElementById('qualityValue');


    chooseImage.addEventListener(
        'click',
        () => imageInput.click()
    );


    uploadZone.addEventListener(
        'click',
        (event) => {

            if (event.target !== chooseImage) {
                imageInput.click();
            }

        }
    );


    imageInput.addEventListener(
        'change',
        function () {

            const file = this.files[0];

            if (!file) {
                return;
            }


            fileName.textContent =
                file.name;


            fileSize.textContent =
                formatFileSize(file.size);


            previewImage.src =
                URL.createObjectURL(file);


            preview.classList.remove(
                'd-none'
            );

        }
    );


    quality.addEventListener(
        'input',
        function () {

            qualityValue.textContent =
                this.value + '%';

        }
    );


    function formatFileSize(bytes)
    {
        if (bytes === 0) {
            return '0 B';
        }

        const units = [
            'B',
            'KB',
            'MB',
            'GB'
        ];

        const i =
            Math.floor(
                Math.log(bytes) /
                Math.log(1024)
            );

        return (
            bytes /
            Math.pow(1024, i)
        ).toFixed(2)
        + ' '
        + units[i];
    }

</script>

@endpush