<?php

namespace App\Http\Controllers;

use App\Models\ImageOptimization;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalOperations = ImageOptimization::where(
            'user_id',
            $userId
        )->count();

        $totalCompressed = ImageOptimization::where(
            'user_id',
            $userId
        )->where(
            'operation',
            'compress'
        )->count();

        $totalResized = ImageOptimization::where(
            'user_id',
            $userId
        )->where(
            'operation',
            'resize'
        )->count();

        $totalConverted = ImageOptimization::where(
            'user_id',
            $userId
        )->where(
            'operation',
            'convert'
        )->count();

        $recentOperations = ImageOptimization::where(
            'user_id',
            $userId
        )
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.index', compact(
            'totalOperations',
            'totalCompressed',
            'totalResized',
            'totalConverted',
            'recentOperations'
        ));
    }
}