<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;
    protected $table = 'profiles';
    protected $primaryKey = 'profiles_id';
    protected $fillable = [
        'user_id', 'username', 'email', 'phone', 'gender', 'date_of_birth', 'height', 'weight', 'profile_image_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

