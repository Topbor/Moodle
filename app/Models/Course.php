<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    protected $table = 'mdl_course';

    protected $guarded = [
        'id'
    ];

    public function courseCategory(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category');
    }

}
