<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Enrolment extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mdl_user_enrolments';

    protected $guarded = [
        'id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function courseComp(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'enrolid');
    }

    public static function lastEnrolment(Collection $activity): array
    {
        return $activity->reduce(function(array $acc, $curr){
            $acc[] = ['time' => $curr->timecreated, 'id' => $curr->id, 'type' => 'enrolment'];
            return $acc;
        }, []);
    }
}
