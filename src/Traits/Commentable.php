<?php

namespace Mgcodeur\LaravelComment\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Auth;
use Mgcodeur\LaravelComment\Exceptions\CommenterNotFoundException;
use Mgcodeur\LaravelComment\Models\Comment;

/**
 * @method \Illuminate\Database\Eloquent\Relations\MorphMany comments()
 * @method Comment comment(string $comment, ?Model $commenter = null)
 */
trait Commentable
{
    public function comments(): MorphMany
    {
        return $this->morphMany(config('comment.models.comment'), 'commentable')
            ->with('replies');
    }

    private function replies(): MorphMany
    {
        return $this->morphMany(config('comment.models.comment'), 'commentable');
    }

    /**
     * @return Comment
     */
    public function comment(string $comment, ?Model $commenter = null): Comment
    {
        $commenter ??= Auth::user();

        if (! $commenter) {
            throw new CommenterNotFoundException;
        }

        /** @var MorphMany<Comment, static> $commentsRelation */
        $commentsRelation = $this->comments();

        /** @var Comment $newComment */
        $newComment = $commentsRelation->create([
            'user_id'        => $commenter->getKey(),
            'commenter_type' => $commenter->getMorphClass(),
            'commenter_id'   => $commenter->getKey(),
            'content'        => $comment,
        ]);

        return $newComment;
    }
}
