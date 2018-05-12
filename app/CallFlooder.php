<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CallFlooder extends Model
{
    //
    protected $fillable = [
        'name', 'seconds', 'numbers', 'num_of_calls', 'audio_id', 'from'
    ];




}
