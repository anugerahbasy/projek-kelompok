<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::where('kurir_id', Auth::id())
            ->with('user')
            ->latest()
            ->paginate(10);
            
        $averageRating = Rating::where('kurir_id', Auth::id())->avg('rating') ?? 0;
        $totalRatings = Rating::where('kurir_id', Auth::id())->count();
        
        $ratingStats = [
            5 => Rating::where('kurir_id', Auth::id())->where('rating', 5)->count(),
            4 => Rating::where('kurir_id', Auth::id())->where('rating', 4)->count(),
            3 => Rating::where('kurir_id', Auth::id())->where('rating', 3)->count(),
            2 => Rating::where('kurir_id', Auth::id())->where('rating', 2)->count(),
            1 => Rating::where('kurir_id', Auth::id())->where('rating', 1)->count(),
        ];

        return view('kurir.ratings.index', compact('ratings', 'averageRating', 'totalRatings', 'ratingStats'));
    }
}