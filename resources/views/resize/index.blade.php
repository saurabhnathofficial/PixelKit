@extends('layouts.app')

@section('title', 'Resize Images - PixelKit')

@section('content')

<section class="compress-page">

    <div class="container py-5">

        {{-- HEADER --}}
        <div class="text-center mb-5">

            <span class="pk-mini-label">
                IMAGE RESIZER
            </span>

            <h1 class="compress-title">
                Resize Images
            </h1>

            <p class="compress-subtitle">
                Change image dimensions without stretching
                or distorting your images.
            </p>

        </div>


        {{-- MAIN CARD --}}
        <div class="compress-card">

            <form
                action="{{ route('images.resize') }}"
                method="POST"
                enctype="multipart/form-data"
                id="resizeForm"
            >

                @csrf


                {{-- UPLOAD --}}
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


                {{-- PREVIEW --}}
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

                        <strong id="fileName"></strong>

                        <small
                            id="fileSize"
                            class="d-block text-muted"
                        ></small>

                        <small
                            id="dimensions"
                            class="d-block text-primary"
                        ></small>

                    </div>

                </div>


                {{-- RESIZE OPTIONS --}}
                <div class="resize-options mt-4">

                    <div class="d-flex
                                justify-content-between
                                align-items-center
                                mb-3">

                        <h5 class="mb-0 fw-bold">
                            Resize Options
                        </h5>

                        <span class="resize-badge">
                            By Dimensions
                        </span>

                    </div>


                    <div class="row g-3">

                        {{-- WIDTH --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Width
                            </label>

                            <div class="input-group">

                                <input
                                    type="number"
                                    class="form-control"
                                    name="width"
                                    id="width"
                                    value="1200"
                                    min="1"
                                    max="5000"
                                    required
                                >

                                <span class="input-group-text">
                                    px
                                </span>

                            </div>

                        </div>


                        {{-- HEIGHT --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Height
                            </label>

                            <div class="input-group">

                                <input
                                    type="number"
                                    class="form-control"
                                    name="height"
                                    id="height"
                                    value="800"
                                    min="1"
                                    max="5000"
                                    required
                                >

                                <span class="input-group-text">
                                    px
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- ASPECT RATIO --}}
                    <div class="form-check mt-4">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="maintainAspect"
                            checked
                        >

                        <label
                            class="form-check-label"
                            for="maintainAspect"
                        >
                            <strong>
                                Maintain aspect ratio
                            </strong>

                            <small class="d-block text-muted">
                                Automatically adjust height when
                                width changes.
                            </small>

                        </label>

                    </div>

                </div>


                {{-- SUBMIT --}}
                <button
                    type="submit"
                    class="compress-submit"
                >
                    ↗ Resize Image
                </button>

            </form>

        </div>


        {{-- RESULT --}}
        @if(session('resize_result'))

            @php
                $result = session('resize_result');
            @endphp

            <div class="result-card mt-5">

                <div class="result-success">
                    ✓
                </div>

                <div>

                    <h4>
                        Resize Complete!
                    </h4>

                    <p>
                        {{ $result['original_filename'] }}
                    </p>

                </div>

                <div class="result-stats">

                    <div>
                        <span>
                            Original
                        </span>

                        <strong>
                            {{ number_format($result['original_size'] / 1024, 2) }} KB
                        </strong>
                    </div>

                    <div class="result-arrow">
                        →
                    </div>

                    <div>
                        <span>
                            Resized
                        </span>

                            <strong>
                                {{ $result['width'] }} × {{ $result['height'] }} px
                            </strong>
                    </div>

                </div>

                <a
                    href="{{ route('images.download', [
                        'filename' => $result['optimized_filename']
                    ]) }}"
                    class="pk-btn pk-btn-primary"
                >
                    ↓ Download Image
                </a>

            </div>

        @endif


        {{-- ERRORS --}}
        @if($errors->any())

            <div class="alert alert-danger mt-4">

                @foreach($errors->all() as $error)

                    <div>
                        {{ $error }}
                    </div>

                @endforeach

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

const dimensions =
    document.getElementById('dimensions');

const widthInput =
    document.getElementById('width');

const heightInput =
    document.getElementById('height');

const maintainAspect =
    document.getElementById('maintainAspect');


let originalWidth = 0;
let originalHeight = 0;
let aspectRatio = 1;


chooseImage.addEventListener(
    'click',
    function (event) {

        event.stopPropagation();

        imageInput.click();

    }
);


uploadZone.addEventListener(
    'click',
    function () {

        imageInput.click();

    }
);


imageInput.addEventListener(
    'change',
    function () {

        const file =
            this.files[0];

        if (!file) {
            return;
        }


        fileName.textContent =
            file.name;


        fileSize.textContent =
            formatFileSize(file.size);


        const objectUrl =
            URL.createObjectURL(file);


        previewImage.onload =
            function () {

                originalWidth =
                    this.naturalWidth;

                originalHeight =
                    this.naturalHeight;

                aspectRatio =
                    originalWidth /
                    originalHeight;


                dimensions.textContent =
                    `${originalWidth} × ${originalHeight}px`;

            };


        previewImage.src =
            objectUrl;


        preview.classList.remove(
            'd-none'
        );

    }
);


/*
|--------------------------------------------------------------------------
| Maintain aspect ratio
|--------------------------------------------------------------------------
*/

widthInput.addEventListener(
    'input',
    function () {

        if (!maintainAspect.checked) {
            return;
        }

        if (!aspectRatio) {
            return;
        }

        const width =
            parseInt(this.value);

        if (!width) {
            return;
        }

        const height =
            Math.round(
                width / aspectRatio
            );

        heightInput.value =
            height;

    }
);


heightInput.addEventListener(
    'input',
    function () {

        if (!maintainAspect.checked) {
            return;
        }

        if (!aspectRatio) {
            return;
        }

        const height =
            parseInt(this.value);

        if (!height) {
            return;
        }

        const width =
            Math.round(
                height * aspectRatio
            );

        widthInput.value =
            width;

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

    const index =
        Math.floor(
            Math.log(bytes) /
            Math.log(1024)
        );

    return (
        bytes /
        Math.pow(1024, index)
    ).toFixed(2)
    + ' '
    + units[index];
}

</script>

@endpush