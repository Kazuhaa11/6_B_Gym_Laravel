<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class profileController extends Controller
{
    // Mengambil data profil pengguna
    public function getProfile(Request $request)
    {
        // Mengambil profil terkait dengan pengguna yang sedang login
        $profile = $request->user()->profile;

        return response()->json([
            'username' => $profile->username,
            'email' => $profile->email,
            'phone' => $profile->phone,
            'gender' => $profile->gender,
            'dateOfBirth' => $profile->date_of_birth,
            'height' => $profile->height,
            'weight' => $profile->weight,
            'profileImagePath' => $profile->profile_image_path,
        ]);
    }

    // Mengupdate data profil pengguna
    public function updateProfile(Request $request)
    {
        // Mengambil profil pengguna yang sedang login
        $profile = $request->user()->profile;

        // Memperbarui data profil berdasarkan input dari request
        $profile->username = $request->username;
        $profile->email = $request->email;
        $profile->phone = $request->phone;
        $profile->gender = $request->gender;
        $profile->date_of_birth = $request->dateOfBirth;
        $profile->height = $request->height;
        $profile->weight = $request->weight;
        $profile->profile_image_path = $request->profileImagePath;

        // Menyimpan perubahan ke database
        $profile->save();

        // Mengirimkan respons sukses
        return response()->json(['message' => 'Profile updated successfully']);
    }
}
