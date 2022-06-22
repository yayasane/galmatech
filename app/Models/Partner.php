<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'picture',
        'phone_number',
        'created_by_user_id',
        'updated_by_user_id',
        'app_id'
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
