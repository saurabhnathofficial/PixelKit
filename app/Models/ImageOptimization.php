<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ImageOptimization extends Model
{
    protected $fillable = [
        'user_id',
        'original_filename',
        'original_path',
        'optimized_filename',
        'optimized_path',
        'original_size',
        'optimized_size',
        'saved_percentage',
        'original_format',
        'output_format',
        'operation',
        'status',
    ];

    protected $casts = [
        'original_size' => 'integer',
        'optimized_size' => 'integer',
        'saved_percentage' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
