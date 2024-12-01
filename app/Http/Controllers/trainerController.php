<?php

namespace App\Http\Controllers;
use App\Models\Trainer;

use Illuminate\Http\Request;

class trainerController extends Controller
{
        public function index()
        {
            return response()->json(Trainer::all());
        }
}
