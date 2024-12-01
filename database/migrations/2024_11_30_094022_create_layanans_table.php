<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->foreignId('id_trainer')->constrained('trainers', 'id_trainer')->onDelete('cascade');
            $table->string('nama_layanan');
            $table->text('description');
            $table->enum('tipe_layanan', ['kelas', 'personal', 'alat']);
            $table->dateTime('jadwal_layanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
