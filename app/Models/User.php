<?php

namespace App\Models;

use App\Enums\UserRoles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'mdl_user';

    protected $guarded = [
        'id'
    ];

    public function completions(): HasMany
    {
        return $this->hasMany(Completions::class,'userid');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'mdl_role_assignments',
            'userid',
            'roleid'
        );
    }

    public function lastaccess(): HasMany
    {
        return $this->hasMany(LastAccess::class,'userid')->orderByDesc('timeaccess')->first();
    }

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'mdl_user_lastaccess',
            'userid',
            'courseid'
        );
    }

    public static function getInstructors(Collection $users): array
    {
        return $users->reduce(function(array $acc, $u){
            if($u->roles->count()>1){
                $role = $u->roles->whereIn('shortname', [
                    UserRoles::TEACHER,
                    UserRoles::COURSECREATOR,
                    UserRoles::EDITINGTEACHER,
                    UserRoles::MANAGER
                    ])->first();
                if($role){
                    $acc[] = $u;
                }
            }
            return $acc;
        }, []);
    }

    public static function getStudents(Collection $users): array
    {
        return $users->reduce(function(array $acc, $u){
            if($u->roles->count()>1){
                $role = $u->roles->where('shortname', UserRoles::STUDENT)->first();
                if($role){
                    $acc[] = $u;
                }
            }
            return $acc;
        }, []);
    }
}
