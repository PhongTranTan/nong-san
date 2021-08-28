<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenureTranslation extends Model
{
    protected $table = 'tenure_translation';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}