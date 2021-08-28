<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogoPartner extends Model
{
    protected $table = 'logo_partner';

    protected $fillable = [
        'type',
        'image',
        'active'
    ];
}
