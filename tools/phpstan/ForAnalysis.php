<?php

namespace Mgcodeur\LaravelComment\Tools\phpstan;

use Illuminate\Database\Eloquent\Model;
use Mgcodeur\LaravelComment\Traits\Commentable;
use Mgcodeur\LaravelComment\Traits\HasComment;

final class ForAnalysis extends Model
{
    use Commentable, HasComment {
        Commentable::comments insteadof HasComment;
        HasComment::comments as hasCommentRelation;
    }
}
