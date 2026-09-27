<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompressImageRequest;
use App\Models\ImageOptimization;
use App\Services\ImageOptimizationService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ResizeImageRequest;
use App\Http\Requests\ConvertImageRequest;
use Illuminate\Support\Facades\Auth;

class ImageCompressionController extends Controller
{
    public function __construct(
        private ImageOptimizationService $imageService
    ) {}


    /**
     * Show compression page.
     */
    public function index()
    {
        return view('compress.index');
    }


    /**
     * Compress image.
     */
    public function compress(
        CompressImageRequest $request
    ) {

        $result =
            $this->imageService->compress(
                $request->file('image'),
                $request->integer('quality')
            );


        /*
        |--------------------------------------------------------------------------
        | Save optimization history
        |--------------------------------------------------------------------------
        */

        ImageOptimization::create([
            'user_id' => Auth::id(),

            'original_filename' =>
            $result['original_filename'],

            'original_path' =>
            null,

            'optimized_filename' =>
            $result['optimized_filename'],

            'optimized_path' =>
            $result['optimized_path'],

            'original_size' =>
            $result['original_size'],

            'optimized_size' =>
            $result['optimized_size'],

            'saved_percentage' =>
            $result['saved_percentage'],

            'original_format' =>
            $result['original_format'],

            'output_format' =>
            $result['output_format'],

            'operation' =>
            'compress',

            'status' =>
            'completed',

        ]);


        return back()->with([

            'success' => true,

            'original_name' =>
            $result['original_filename'],

            'original_size' =>
            $this->formatBytes(
                $result['original_size']
            ),

            'optimized_size' =>
            $this->formatBytes(
                $result['optimized_size']
            ),

            'saved_percentage' =>
            $result['saved_percentage'],

            'download_filename' =>
            $result['optimized_filename'],

        ]);
    }


    public function resizePage()
    {
        return view('resize.index');
    }

    public function resize(ResizeImageRequest $request)
    {
        $result = $this->imageService->resize(
            $request->file('image'),
            $request->width,
            $request->height
        );

        ImageOptimization::create([
            'user_id' => Auth::id(),
            'original_filename' => $result['original_filename'],
            'original_path' => null,

            'optimized_filename' => $result['optimized_filename'],
            'optimized_path' => $result['optimized_path'],

            'original_size' => $result['original_size'],
            'optimized_size' => $result['optimized_size'],

            'saved_percentage' => $result['saved_percentage'],

            'original_format' => $result['original_format'],
            'output_format' => $result['output_format'],

            'operation' => 'resize',
            'status' => 'completed',
        ]);

        return back()->with('resize_result', $result);
    }
    /**
     * Download optimized image.
     */
    public function download($filename)
    {
        $image = ImageOptimization::where(
            'user_id',
            Auth::id()
        )
            ->where(
                'optimized_filename',
                $filename
            )
            ->firstOrFail();

        $disk = Storage::disk('public');

        if (!$disk->exists($image->optimized_path)) {
            abort(404);
        }

        $filePath = $disk->path($image->optimized_path);

        return response()
            ->download(
                $filePath,
                $image->optimized_filename
            )
            ->deleteFileAfterSend(true);
    }


    /**
     * Format bytes.
     */
    private function formatBytes(
        int $bytes
    ): string {

        if ($bytes <= 0) {
            return '0 B';
        }


        $units = [
            'B',
            'KB',
            'MB',
            'GB',
        ];


        $power =
            floor(
                log($bytes, 1024)
            );


        $power =
            min(
                $power,
                count($units) - 1
            );


        return round(
            $bytes / pow(1024, $power),
            2
        ) . ' ' . $units[$power];
    }

    public function convertPage()
    {
        return view('convert.index');
    }

    public function convert(ConvertImageRequest $request)
    {
        $result = $this->imageService->convertToWebp(
            $request->file('image')
        );

        ImageOptimization::create([
            'user_id' => Auth::id(),
            'original_filename' => $result['original_filename'],
            'original_path' => null,

            'optimized_filename' => $result['optimized_filename'],
            'optimized_path' => $result['optimized_path'],

            'original_size' => $result['original_size'],
            'optimized_size' => $result['optimized_size'],

            'saved_percentage' => $result['saved_percentage'],

            'original_format' => $result['original_format'],
            'output_format' => $result['output_format'],

            'operation' => 'convert',
            'status' => 'completed',
        ]);

        return back()->with(
            'convert_result',
            $result
        );
    }
}
