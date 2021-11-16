<?php

namespace App\Exceptions;

use Exception;

class AuthenticationAttemptException extends Exception
{
    public int $status = 422;
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
