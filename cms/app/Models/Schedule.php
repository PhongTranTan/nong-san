<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule_showflat';

    protected $fillable = [
        'fullname',
        'phone',
        'email',
        'date',
        'time',
        'budget',
        'number_of_rooms',
        'property',
        'project_id',
        'type',
        'message',
        'agree'
    ];
}
