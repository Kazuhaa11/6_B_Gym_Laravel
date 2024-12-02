<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class layananController extends Controller
{
    // Menampilkan layanan berdasarkan tanggal
    public function getLayananByDate($date)
    {
        $layanans = Layanan::where('class_date', $date)->get();
        return response()->json($layanans);
    }

    // Menampilkan semua layanan
    public function index()
    {
        // Mengambil semua data layanan
        $layanan = Layanan::all();
        return response()->json($layanan);
    }

    // Menampilkan layanan berdasarkan ID
    public function show($id)
    {
        // Mencari layanan berdasarkan ID
        $layanan = Layanan::find($id);

        if (!$layanan) {
            return response()->json(['message' => 'Layanan not found'], 404);
        }

        return response()->json($layanan);
    }

    // Menambah layanan baru
    public function store(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'class_name' => 'required|string|max:255',
            'time_start' => 'required|string|max:5',
            'time_end' => 'required|string|max:5',
            'duration' => 'required|string|max:255',
            'burned_calories' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'reviews' => 'required|integer|min:0',
            'description' => 'required|string',
            'state' => 'required|in:available,unavailable',
            'image_path' => 'required|string',
            'reminder_time' => 'required|string|max:5',
        ]);

        // Menambahkan data layanan baru
        $layanan = Layanan::create($request->all());

        return response()->json([
            'message' => 'Layanan created successfully',
            'layanan' => $layanan,
        ], 201);
    }

    // Mengupdate layanan yang ada
    public function update(Request $request, $id)
    {
        // Mencari layanan berdasarkan ID
        $layanan = Layanan::find($id);

        if (!$layanan) {
            return response()->json(['message' => 'Layanan not found'], 404);
        }

        // Validasi inputan
        $request->validate([
            'class_name' => 'required|string|max:255',
            'time_start' => 'required|string|max:5',
            'time_end' => 'required|string|max:5',
            'duration' => 'required|string|max:255',
            'burned_calories' => 'required|string|max:255',
            'instructor' => 'required|string|max:255',
            'rating' => 'required|numeric|min:0|max:5',
            'reviews' => 'required|integer|min:0',
            'description' => 'required|string',
            'state' => 'required|in:available,unavailable',
            'image_path' => 'required|string',
            'reminder_time' => 'required|string|max:5',
        ]);

        // Mengupdate data layanan
        $layanan->update($request->all());

        return response()->json([
            'message' => 'Layanan updated successfully',
            'layanan' => $layanan,
        ]);
    }

    // Menghapus layanan berdasarkan ID
    public function destroy($id)
    {
        // Mencari layanan berdasarkan ID
        $layanan = Layanan::find($id);

        if (!$layanan) {
            return response()->json(['message' => 'Layanan not found'], 404);
        }

        // Menghapus layanan
        $layanan->delete();

        return response()->json(['message' => 'Layanan deleted successfully']);
    }
}
