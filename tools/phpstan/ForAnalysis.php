<?php

namespace Mgcodeur\LaravelComment\Tools\phpstan;

use Illuminate\Database\Eloquent\Model;
use Mgcodeur\LaravelComment\Traits\Commentable;
use Mgcodeur\LaravelComment\Traits\HasComment;

class ForAnalysis extends Model
{
    use Commentable;
    use HasComment;
}
