<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteExpiredImages extends Command
{
    protected $signature = 'images:cleanup';

    protected $description = 'Delete optimized images older than 1 hour';

    public function handle(): int
    {
        $disk = Storage::disk('public');

        $files = $disk->files('optimized');

        $deleted = 0;

        foreach ($files as $file) {

            $lastModified = $disk->lastModified($file);

            // 1 hour = 3600 seconds
            if (now()->timestamp - $lastModified >= 3600) {

                $disk->delete($file);

                $deleted++;
            }
        }

        $this->info("Cleanup completed. Deleted {$deleted} expired image(s).");

        return self::SUCCESS;
    }
}