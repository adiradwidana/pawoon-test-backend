<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'name', 'address'
    ];

    public static function boot()
    {
        parent::boot();
        
        self::creating(function ($model) {
            $model->id = (string) Uuid::generate(4);
        });
    }
}
