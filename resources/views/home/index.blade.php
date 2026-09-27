@extends('layouts.app')

@section('title', 'PixelKit — Image Optimization Made Simple')

@section('content')

{{-- =========================================================
     HERO
========================================================= --}}
<section class="pk-hero">

    <div class="pk-glow pk-glow-1"></div>
    <div class="pk-glow pk-glow-2"></div>

    <div class="container position-relative">

        <div class="row align-items-center min-vh-75 g-5">

            {{-- LEFT --}}
            <div class="col-lg-6">

                <div class="pk-pill mb-4">
                    <span class="pk-dot"></span>
                    Fast · Private · Free
                </div>

                <h1 class="pk-hero-title">
                    Optimize Images
                    <br>
                    For a
                    <span>Faster Web.</span>
                </h1>

                <p class="pk-hero-text">
                    Compress, resize and convert your images to WebP
                    without compromising quality.
                    Fast, simple and completely browser-friendly.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">

                    <a href="compress" class="pk-btn pk-btn-primary">
                        Start Optimizing
                        <span>→</span>
                    </a>

                    <a href="#features" class="pk-btn pk-btn-light">
                        View Features
                    </a>

                </div>

                {{-- TRUST ITEMS --}}
                <div class="pk-trust-row mt-5">

                    <div class="pk-trust">
                        <div class="pk-trust-icon orange">⚡</div>
                        <div>
                            <strong>Fast</strong>
                            <small>Processing</small>
                        </div>
                    </div>

                    <div class="pk-trust">
                        <div class="pk-trust-icon purple">✦</div>
                        <div>
                            <strong>High Quality</strong>
                            <small>Output</small>
                        </div>
                    </div>

                    <div class="pk-trust">
                        <div class="pk-trust-icon green">🔒</div>
                        <div>
                            <strong>Private</strong>
                            <small>Your files</small>
                        </div>
                    </div>

                    <div class="pk-trust">
                        <div class="pk-trust-icon red">♥</div>
                        <div>
                            <strong>Free</strong>
                            <small>Forever</small>
                        </div>
                    </div>

                </div>

            </div>


            {{-- RIGHT VISUAL --}}
            <div class="col-lg-6">

                <div class="pk-hero-visual">

                    <div class="pk-orbit pk-orbit-one"></div>
                    <div class="pk-orbit pk-orbit-two"></div>

                    {{-- Reduction badge --}}
                    <div class="pk-saving-badge">
                        <strong>-86%</strong>
                        <span>Smaller Size</span>
                    </div>

                    {{-- Lightning --}}
                    <div class="pk-floating-icon pk-lightning">
                        ⚡
                    </div>

                    {{-- BEFORE CARD --}}
                    <div class="pk-image-card pk-before">

                        <div class="pk-image-placeholder mountain"></div>

                        <div class="pk-card-content">
                            <small>BEFORE</small>
                            <strong>2.4 MB</strong>
                        </div>

                    </div>


                    {{-- ARROW --}}
                    <div class="pk-convert-arrow">
                        →
                    </div>


                    {{-- AFTER CARD --}}
                    <div class="pk-image-card pk-after">

                        <div class="pk-webp-label">
                            WebP
                        </div>

                        <div class="pk-image-placeholder mountain after"></div>

                        <div class="pk-card-content">
                            <small>AFTER</small>
                            <strong>320 KB</strong>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>


{{-- =========================================================
     FORMATS
========================================================= --}}
<section class="pk-formats">

    <div class="container">

        <div class="text-center">

            <span class="pk-section-label">
                SUPPORTED FORMATS
            </span>

            <div class="pk-format-list">

                <div>
                    <span class="format-icon jpg">J</span>
                    JPG
                </div>

                <div>
                    <span class="format-icon png">P</span>
                    PNG
                </div>

                <div>
                    <span class="format-icon webp">W</span>
                    WebP
                </div>

                <div>
                    <span class="format-icon gif">G</span>
                    GIF
                </div>

                <div>
                    <span class="format-icon bmp">B</span>
                    BMP
                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     FEATURES
========================================================= --}}
<section id="features" class="pk-features">

    <div class="container">

        <div class="pk-heading text-center">

            <span class="pk-mini-label">
                POWERFUL TOOLS
            </span>

            <h2>
                Everything You Need for
                <span>Image Optimization</span>
            </h2>

            <p>
                Simple, powerful tools to make your images
                smaller, faster and ready for the web.
            </p>

        </div>


        <div class="row g-4 mt-4">

            {{-- CARD --}}
            <div class="col-md-6 col-xl-3">

                <div class="pk-feature-card blue">

                    <div class="pk-feature-icon">
                        ⚡
                    </div>

                    <h4>Compress Images</h4>

                    <p>
                        Reduce image file size while maintaining
                        excellent visual quality.
                    </p>

                    <a href="compress">
                        Compress Now <span>→</span>
                    </a>

                </div>

            </div>


            {{-- CARD --}}
            <div class="col-md-6 col-xl-3">

                <div class="pk-feature-card purple">

                    <div class="pk-feature-icon">
                        ⛶
                    </div>

                    <h4>Resize Images</h4>

                    <p>
                        Change image dimensions for websites,
                        social media and more.
                    </p>

                    <a href="resize">
                        Resize Now <span>→</span>
                    </a>

                </div>

            </div>


            {{-- CARD --}}
            <div class="col-md-6 col-xl-3">

                <div class="pk-feature-card green">

                    <div class="pk-feature-icon">
                        ◉
                    </div>

                    <h4>Convert to WebP</h4>

                    <p>
                        Convert JPG and PNG images to
                        modern WebP format.
                    </p>

                    <a href="convert">
                        Convert Now <span>→</span>
                    </a>

                </div>

            </div>


            {{-- CARD --}}
            <div class="col-md-6 col-xl-3">

                <div class="pk-feature-card orange">

                    <div class="pk-feature-icon">
                        ✨
                    </div>

                    <h4>Batch Processing</h4>

                    <p>
                        Optimize multiple images at
                        the same time.
                    </p>

                    <a href="#" class="disabled-link">
                        Coming Soon
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     HOW IT WORKS
========================================================= --}}
<section class="pk-how">

    <div class="pk-wave"></div>

    <div class="container position-relative">

        <div class="text-center text-white">

            <span class="pk-mini-label light">
                SIMPLE WORKFLOW
            </span>

            <h2>
                How It Works
            </h2>

            <p class="opacity-75">
                Optimize your images in three simple steps.
            </p>

        </div>


        <div class="row mt-5 g-5">

            <div class="col-md-4">

                <div class="pk-step">

                    <div class="pk-step-number">
                        1
                    </div>

                    <div class="pk-step-line"></div>

                    <h4>Upload</h4>

                    <p>
                        Choose an image or simply drag
                        and drop it into PixelKit.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="pk-step">

                    <div class="pk-step-number">
                        2
                    </div>

                    <div class="pk-step-line"></div>

                    <h4>Optimize</h4>

                    <p>
                        PixelKit compresses, resizes
                        or converts your image.
                    </p>

                </div>

            </div>


            <div class="col-md-4">

                <div class="pk-step">

                    <div class="pk-step-number">
                        3
                    </div>

                    <h4>Download</h4>

                    <p>
                        Download your optimized image
                        instantly.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- =========================================================
     CTA
========================================================= --}}
<section class="pk-final-cta">

    <div class="container text-center">

        <div class="pk-cta-box">

            <div class="pk-cta-glow"></div>

            <span class="pk-mini-label light">
                READY TO OPTIMIZE?
            </span>

            <h2>
                Make Your Images
                <span>Web-Ready.</span>
            </h2>

            <p>
                Compress your first image in seconds.
                No complicated setup required.
            </p>

            <a href="compress" class="pk-btn pk-btn-white">
                Start Optimizing →
            </a>

        </div>

    </div>

</section>

@endsection