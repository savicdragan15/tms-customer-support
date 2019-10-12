<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'phone_number',
        'order_number',
        'email',
        'description',
        'callback_date',
    ];
}
