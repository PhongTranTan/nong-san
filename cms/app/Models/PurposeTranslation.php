<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurposeTranslation extends Model
{
    protected $table = 'purpose_translation';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}