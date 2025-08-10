<?php

namespace Mgcodeur\LaravelComment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property int|null $user_id
 * @property int|null $commentable_id
 * @property string|null $commentable_type
 * @property string|null $commenter_type
 * @property int|null $commenter_id
 * @property int|null $parent_id
 * @property string $content
 * @property-read \Illuminate\Database\Eloquent\Collection<int,self> $replies
 * @property-read int|null $replies_count
 *
 * @method MorphTo commentable()
 * @method MorphTo commenter()
 * @method HasMany replies()
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
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
        'content',
    ];

    protected $hidden = [
        'commentable_type',
        'commentable_id',
        'commenter_type',
        'commenter_id',
        'parent_id',
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function commenter(): MorphTo
    {
        return $this->morphTo();
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->with('replies');
    }
}
