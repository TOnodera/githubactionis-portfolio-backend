<?php

namespace App\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    public int $status = 401;
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
