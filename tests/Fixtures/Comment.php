<?php

namespace Mgcodeur\LaravelComment\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'commentable_id',
        'commentable_type',
        'commenter_type',
        'commenter_id',
        'parent_id',
        'user_id',
        'content',
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commenter(): MorphTo
    {
        return $this->morphTo();
    }
}
