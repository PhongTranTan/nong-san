<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    protected $table = 'budgets';

    public $timestamps = false;

    protected $fillable = [
        'budgets'
    ];
}
