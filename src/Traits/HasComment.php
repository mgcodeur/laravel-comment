<?php

namespace Mgcodeur\LaravelComment\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany comments()
 */
trait HasComment
{
    public function comments(): MorphMany
    {
        return $this->morphMany(config('comment.models.comment'), 'commenter')
            ->with('replies');
    }

    private function replies(): MorphMany
    {
        return $this->morphMany(config('comment.models.comment'), 'commenter');
    }
}
