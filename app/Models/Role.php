<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{

    protected $table = 'mdl_role';

    protected $guarded = [
        'id'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'mdl_role_assignments',
            'roleid',
            'userid'
        );

    }

}
