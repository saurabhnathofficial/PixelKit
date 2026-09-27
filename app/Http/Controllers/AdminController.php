<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ImageOptimization;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalOperations = ImageOptimization::count();

        $totalCompressed = ImageOptimization::where(
            'operation',
            'compress'
        )->count();

        $totalResized = ImageOptimization::where(
            'operation',
            'resize'
        )->count();

        $totalConverted = ImageOptimization::where(
            'operation',
            'convert'
        )->count();

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        $recentOperations = ImageOptimization::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalOperations',
            'totalCompressed',
            'totalResized',
            'totalConverted',
            'recentUsers',
            'recentOperations'
        ));
    }
}