<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;

class bookingController extends Controller
{
    public function index()
        {
            return response()->json(Booking::all());
        }
}
