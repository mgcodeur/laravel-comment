<?php

namespace Mgcodeur\LaravelComment\Tests\Fixtures;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Mgcodeur\LaravelComment\Traits\HasComment;

class User extends Authenticatable
{
    use HasComment;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
