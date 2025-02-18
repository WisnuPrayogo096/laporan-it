<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';

    protected $fillable = [
        'time',
        'message_received'
    ];

    protected $casts = [
        'time' => 'datetime'
    ];
}