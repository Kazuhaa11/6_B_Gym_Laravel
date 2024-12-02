<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'layanan_id',
        'booking_time',
        'reminder_time',
        'state', // Menambahkan kolom state untuk status pemesanan
    ];

    protected $casts = [
        'reminder_time' => 'datetime', // Cast reminder_time sebagai datetime
    ];

    // Relasi ke model Layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }

    // Fungsi untuk mengubah waktu reminder setelah booking
    public function updateReminderTime($reminder_time)
    {
        if ($this->state === 'ordered') {
            $this->reminder_time = $reminder_time;
            $this->save();
        }
    }

    // Fungsi untuk mengubah state booking
    public function updateState($state)
    {
        $this->state = $state;
        $this->save();
    }

    // Fungsi untuk membatalkan booking jika belum dibayar
    public function cancelBooking()
    {
        if ($this->state === 'ordered') {
            $this->delete();  // Hapus booking
            $this->layanan->increment('available_slots');
        }
    }
}
