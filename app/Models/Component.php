<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Component extends \Illuminate\Database\Eloquent\Model
{
    use HasFactory;

    protected $table = 'mdl_constructor_component';

    protected $guarded = [
        'id'
    ];
}
