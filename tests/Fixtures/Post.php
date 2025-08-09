<?php

namespace Mgcodeur\LaravelComment\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;
use Mgcodeur\LaravelComment\Traits\Commentable;

class Post extends Model
{
    use Commentable;

    protected $guarded = [];
}
