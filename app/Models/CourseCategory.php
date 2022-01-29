<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseCategory extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mdl_course_categories';

    protected $guarded = [
        'id'
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'category');
    }
}
