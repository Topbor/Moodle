<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Completions extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mdl_course_completions';

    protected $guarded = [
        'id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function courseComp(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course');
    }

    public static function lastCompleted(Collection $activity): array
    {
        return $activity->reduce(function(array $acc, $curr){
            $acc[] = ['time' => $curr->timecompleted, 'id' => $curr->id];
            return $acc;
        }, []);

    }

    public static function lastEnrolment(Collection $activity): array
    {
        return $activity->reduce(function(array $acc, $curr){
            $acc[] = ['time' => $curr->timeenrolled, 'id' => $curr->id];
            return $acc;
        }, []);
    }
}
