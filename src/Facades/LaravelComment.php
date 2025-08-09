<?php

namespace Mgcodeur\LaravelComment\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mgcodeur\LaravelComment\LaravelComment
 */
class LaravelComment extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Mgcodeur\LaravelComment\LaravelComment::class;
    }
}
