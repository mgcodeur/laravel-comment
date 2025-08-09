<?php

namespace Mgcodeur\LaravelComment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $commentable_id
 * @property string $commentable_type
 * @property string $commenter_type
 * @property int $commenter_id
 * @property int $parent_id
 * @property string $content
 *
 * @method MorphTo commentable()
 * @method MorphTo commenter()
 */
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

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }
}
