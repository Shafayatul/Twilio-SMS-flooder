<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwilioCredential extends Model
{
    protected $fillable = [
        'sid', 'token'
    ];
}
