<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'title',
        'title_en',
        'description',
        'description_en',
        'picture',
        'address',
        'facebook',
        'instagram',
        'twiiter',
        'linkedin',
        'created_by_user_id',
        'updated_by_user_id',
        'app_id'
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
