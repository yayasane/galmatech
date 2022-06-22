<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'description',
        'description_en',
        'icon',
        'created_by_user_id',
        'updated_by_user_id',
        'app_id'
    ];

    public function app()
    {
        return $this->belongsTo(App::class);
    }
}
