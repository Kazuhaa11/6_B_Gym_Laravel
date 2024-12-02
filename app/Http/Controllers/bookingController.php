<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Layanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class bookingController extends Controller
{
    // Fungsi untuk melakukan booking
    public function bookClass(Request $request)
    {
        $layanan = Layanan::findOrFail($request->layanan_id);

        // Cek apakah masih ada slot yang tersedia
        if ($layanan->available_slots > 0) {
            // Membuat booking dengan state 'ordered'
            $booking = Booking::create([
                'user_id' => $request->user_id,
                'layanan_id' => $request->layanan_id,
                'booking_time' => Carbon::now(),
                'reminder_time' => $layanan->reminder_time,  // Menggunakan waktu default untuk reminder
                'state' => 'ordered',  // Set state 'ordered' untuk booking yang belum dibayar
            ]);

            return response()->json($booking, 201);
        }

        return response()->json(['message' => 'No available slots'], 400);
    }

    // Fungsi untuk memperbarui waktu reminder
    public function updateReminderTime(Request $request, $bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Hanya user yang dalam state 'ordered' yang bisa mengubah reminder_time
        if ($booking->state === 'ordered') {
            $booking->updateReminderTime($request->reminder_time);
            return response()->json($booking, 200);
        }

        return response()->json(['message' => 'Reminder time cannot be changed once booked'], 400);
    }

    // Fungsi untuk membayar dan mengubah status menjadi 'booked'
    public function payAndBook($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        if ($booking->state === 'ordered') {
            // Update status booking menjadi 'booked'
            $booking->updateState('booked');

            // Kurangi available slots setelah status berubah menjadi 'booked'
            $layanan = $booking->layanan;
            $layanan->available_slots--;
            $layanan->save();

            return response()->json(['message' => 'Booking confirmed and class booked'], 200);
        }

        return response()->json(['message' => 'Booking cannot be confirmed because it is not in ordered state'], 400);
    }

    // Fungsi untuk membatalkan booking
    public function cancelBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);

        // Hanya user dalam state 'ordered' yang bisa membatalkan
        if ($booking->state === 'ordered') {
            $booking->cancelBooking();  // Menghapus booking dan menambah kembali available slot
            return response()->json(['message' => 'Booking canceled successfully'], 200);
        }

        return response()->json(['message' => 'Cannot cancel a booked class'], 400);
    }
}
