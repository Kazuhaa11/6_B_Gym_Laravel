<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;

class reviewController extends Controller
{
    public function index()
        {
            return response()->json(Review::all());
        }
}
