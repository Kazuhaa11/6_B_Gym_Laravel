<?php

namespace App\Http\Controllers;
use App\Models\Layanan;
use Illuminate\Http\Request;

class layananController extends Controller
{
    public function index()
        {
            return response()->json(Layanan::all());
        }
}
