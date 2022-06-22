<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'slogan',
        'slogan_en',
        'whoweare',
        'whoweare_en',
        'email',
        'address',
        'phone_number',
        'phone_number_two',
        'website',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'youtube',
        'email_sign',
        'email_sign_en',
        'user_id',
        'updated_by_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
