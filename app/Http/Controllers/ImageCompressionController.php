<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ImageCompressionController extends Controller
{
    /**
     * Display compression page.
     */
    public function index()
    {
        return view('compress.index');
    }

    /**
     * Compress uploaded image.
     */
    public function compress(Request $request)
    {
        $request->validate([
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
            'quality' => [
                'required',
                'integer',
                'min:10',
                'max:100',
            ],
        ]);


        $uploadedFile = $request->file('image');

        /*
        |--------------------------------------------------------------------------
        | Original information
        |--------------------------------------------------------------------------
        */

        $originalName = $uploadedFile->getClientOriginalName();

        $originalSize = $uploadedFile->getSize();

        $originalExtension =
            strtolower($uploadedFile->getClientOriginalExtension());


        /*
        |--------------------------------------------------------------------------
        | Generate unique filename
        |--------------------------------------------------------------------------
        */

        $filename = uniqid('pixelkit_') . '.jpg';


        /*
        |--------------------------------------------------------------------------
        | Read image
        |--------------------------------------------------------------------------
        */

        $image = Image::read($uploadedFile);


        /*
        |--------------------------------------------------------------------------
        | Compress image
        |--------------------------------------------------------------------------
        */

        $quality = (int) $request->quality;

        $encodedImage = $image->toJpeg($quality);


        /*
        |--------------------------------------------------------------------------
        | Store optimized image
        |--------------------------------------------------------------------------
        */

        $path = 'optimized/' . $filename;

        Storage::disk('public')->put(
            $path,
            (string) $encodedImage
        );


        /*
        |--------------------------------------------------------------------------
        | Get optimized size
        |--------------------------------------------------------------------------
        */

        $optimizedSize =
            Storage::disk('public')->size($path);


        /*
        |--------------------------------------------------------------------------
        | Calculate savings
        |--------------------------------------------------------------------------
        */

        $savedBytes =
            max(0, $originalSize - $optimizedSize);


        $savedPercentage =
            $originalSize > 0
                ? ($savedBytes / $originalSize) * 100
                : 0;


        /*
        |--------------------------------------------------------------------------
        | Response
        |--------------------------------------------------------------------------
        */

        return back()->with([
            'success' => true,

            'original_name' =>
                $originalName,

            'original_size' =>
                $this->formatBytes($originalSize),

            'optimized_size' =>
                $this->formatBytes($optimizedSize),

            'saved_percentage' =>
                round($savedPercentage, 2),

            'download_filename' => $filename,
        ]);
    }


    /**
     * Convert bytes into readable format.
     */
    private function formatBytes($bytes)
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = [
            'B',
            'KB',
            'MB',
            'GB'
        ];

        $power = floor(
            log($bytes, 1024)
        );

        $power = min(
            $power,
            count($units) - 1
        );

        return round(
            $bytes / pow(1024, $power),
            2
        ) . ' ' . $units[$power];
    }
}