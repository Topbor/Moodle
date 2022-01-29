<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LastAccess extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mdl_user_lastaccess';

    protected $guarded = [
        'id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function courseAcc(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course');
    }
}
