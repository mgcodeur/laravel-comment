<?php

namespace Mgcodeur\LaravelComment\Exceptions;

use Exception;

class CommenterNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Commenter not found.');
    }
}
