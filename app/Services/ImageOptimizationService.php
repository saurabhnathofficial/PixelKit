<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageOptimizationService
{
    /*
    |--------------------------------------------------------------------------
    | Compress Image
    |--------------------------------------------------------------------------
    */

    public function compress(
        UploadedFile $file,
        int $quality
    ): array {

        /*
        |----------------------------------------------------------------------
        | Original information
        |----------------------------------------------------------------------
        */

        $originalName =
            $file->getClientOriginalName();

        $originalSize =
            $file->getSize();

        $originalExtension =
            strtolower(
                $file->getClientOriginalExtension()
            );


        /*
        |----------------------------------------------------------------------
        | Generate unique filename
        |----------------------------------------------------------------------
        */

        $originalBaseName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $filename =
            $originalBaseName . '_compressed.jpg';

        $counter = 1;

        while (
            Storage::disk('public')
                ->exists('optimized/' . $filename)
        ) {

            $filename =
                $originalBaseName .
                '_compressed_' .
                $counter .
                '.jpg';

            $counter++;
        }


        /*
        |----------------------------------------------------------------------
        | Read image
        |----------------------------------------------------------------------
        */

        $image =
            Image::read($file);


        /*
        |----------------------------------------------------------------------
        | Compress
        |----------------------------------------------------------------------
        */

        $encodedImage =
            $image->toJpeg($quality);


        /*
        |----------------------------------------------------------------------
        | Storage
        |----------------------------------------------------------------------
        */

        $optimizedPath =
            'optimized/' . $filename;

        Storage::disk('public')->put(
            $optimizedPath,
            (string) $encodedImage
        );


        /*
        |----------------------------------------------------------------------
        | Optimized size
        |----------------------------------------------------------------------
        */

        $optimizedSize =
            Storage::disk('public')
                ->size($optimizedPath);


        /*
        |----------------------------------------------------------------------
        | Calculate savings
        |----------------------------------------------------------------------
        */

        $savedBytes =
            max(
                0,
                $originalSize - $optimizedSize
            );

        $savedPercentage =
            $originalSize > 0
                ? ($savedBytes / $originalSize) * 100
                : 0;


        /*
        |----------------------------------------------------------------------
        | Return processing information
        |----------------------------------------------------------------------
        */

        return [

            'original_filename' =>
                $originalName,

            'original_size' =>
                $originalSize,

            'optimized_size' =>
                $optimizedSize,

            'saved_percentage' =>
                round($savedPercentage, 2),

            'original_format' =>
                $originalExtension,

            'output_format' =>
                'jpg',

            'optimized_filename' =>
                $filename,

            'optimized_path' =>
                $optimizedPath,

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Resize Image
    |--------------------------------------------------------------------------
    */

    public function resize(
        UploadedFile $file,
        int $width,
        int $height
    ): array {

        /*
        |----------------------------------------------------------------------
        | Original information
        |----------------------------------------------------------------------
        */

        $originalName =
            $file->getClientOriginalName();

        $originalSize =
            $file->getSize();

        $originalExtension =
            strtolower(
                $file->getClientOriginalExtension()
            );


        /*
        |----------------------------------------------------------------------
        | Generate output filename
        |----------------------------------------------------------------------
        */

        $originalBaseName = pathinfo(
            $originalName,
            PATHINFO_FILENAME
        );

        $filename =
            $originalBaseName . '_resized.jpg';

        $counter = 1;

        while (
            Storage::disk('public')
                ->exists('optimized/' . $filename)
        ) {

            $filename =
                $originalBaseName .
                '_resized_' .
                $counter .
                '.jpg';

            $counter++;
        }


        /*
        |----------------------------------------------------------------------
        | Read image
        |----------------------------------------------------------------------
        */

        $image =
            Image::read($file);


        /*
        |----------------------------------------------------------------------
        | Resize
        |----------------------------------------------------------------------
        */

        $image->scale(
            width: $width,
            height: $height
        );


        /*
        |----------------------------------------------------------------------
        | Convert to JPEG
        |----------------------------------------------------------------------
        */

        $encodedImage =
            $image->toJpeg(90);


        /*
        |----------------------------------------------------------------------
        | Store
        |----------------------------------------------------------------------
        */

        $optimizedPath =
            'optimized/' . $filename;

        Storage::disk('public')->put(
            $optimizedPath,
            (string) $encodedImage
        );


        /*
        |----------------------------------------------------------------------
        | Get optimized size
        |----------------------------------------------------------------------
        */

        $optimizedSize =
            Storage::disk('public')
                ->size($optimizedPath);


        /*
        |----------------------------------------------------------------------
        | Calculate size reduction
        |----------------------------------------------------------------------
        */

        $savedBytes =
            max(
                0,
                $originalSize - $optimizedSize
            );

        $savedPercentage =
            $originalSize > 0
                ? ($savedBytes / $originalSize) * 100
                : 0;


        /*
        |----------------------------------------------------------------------
        | Return result
        |----------------------------------------------------------------------
        */

        return [

            'original_filename' =>
                $originalName,

            'original_size' =>
                $originalSize,

            'optimized_size' =>
                $optimizedSize,

            'saved_percentage' =>
                round($savedPercentage, 2),

            'original_format' =>
                $originalExtension,

            'output_format' =>
                'jpg',

            'optimized_filename' =>
                $filename,

            'optimized_path' =>
                $optimizedPath,

            /*
            | Actual dimensions after resize
            */

            'width' =>
                $image->width(),

            'height' =>
                $image->height(),

        ];
    }


    /*
    |--------------------------------------------------------------------------
    | Convert Image to WebP
    |--------------------------------------------------------------------------
    */

    public function convertToWebp(
        UploadedFile $file
    ): array {

        /*
        |----------------------------------------------------------------------
        | Original information
        |----------------------------------------------------------------------
        */

        $originalName =
            $file->getClientOriginalName();

        $originalSize =
            $file->getSize();

        $originalExtension =
            strtolower(
                $file->getClientOriginalExtension()
            );


        /*
        |----------------------------------------------------------------------
        | Generate output filename
        |----------------------------------------------------------------------
        */

        $originalBaseName = pathinfo(
            $originalName,
            PATHINFO_FILENAME
        );

        $filename =
            $originalBaseName . '_converted.webp';

        $counter = 1;

        while (
            Storage::disk('public')
                ->exists('optimized/' . $filename)
        ) {

            $filename =
                $originalBaseName .
                '_converted_' .
                $counter .
                '.webp';

            $counter++;
        }


        /*
        |----------------------------------------------------------------------
        | Read image
        |----------------------------------------------------------------------
        */

        $image =
            Image::read($file);


        /*
        |----------------------------------------------------------------------
        | Convert to WebP
        |----------------------------------------------------------------------
        */

        $encodedImage =
            $image->toWebp(90);


        /*
        |----------------------------------------------------------------------
        | Storage
        |----------------------------------------------------------------------
        */

        $optimizedPath =
            'optimized/' . $filename;

        Storage::disk('public')->put(
            $optimizedPath,
            (string) $encodedImage
        );


        /*
        |----------------------------------------------------------------------
        | Optimized size
        |----------------------------------------------------------------------
        */

        $optimizedSize =
            Storage::disk('public')
                ->size($optimizedPath);


        /*
        |----------------------------------------------------------------------
        | Calculate savings
        |----------------------------------------------------------------------
        */

        $savedBytes =
            max(
                0,
                $originalSize - $optimizedSize
            );

        $savedPercentage =
            $originalSize > 0
                ? ($savedBytes / $originalSize) * 100
                : 0;


        /*
        |----------------------------------------------------------------------
        | Return result
        |----------------------------------------------------------------------
        */

        return [

            'original_filename' =>
                $originalName,

            'original_size' =>
                $originalSize,

            'optimized_size' =>
                $optimizedSize,

            'saved_percentage' =>
                round($savedPercentage, 2),

            'original_format' =>
                $originalExtension,

            'output_format' =>
                'webp',

            'optimized_filename' =>
                $filename,

            'optimized_path' =>
                $optimizedPath,

        ];
    }
}