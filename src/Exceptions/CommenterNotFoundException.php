<?php

namespace Mgcodeur\LaravelComment\Exceptions;

use Exception;

class CommenterNotFoundException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param  string  $commenterType
     * @param  int  $commenterId
     */
    public function __construct()
    {
        parent::__construct('Commenter not found.');
    }
}
