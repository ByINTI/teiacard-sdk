<?php

namespace TeiaCardSdk\Exceptions;

use Exception;
use Throwable;

class TeiaCardBaseException extends Exception
{
    private $error;

    public function __construct(string $error, string $message, int $statusCode, Throwable $previous = null)
    {
        $this->error   = $error;
        $this->message = $message;
        $this->code    = $statusCode ?: 500;

        parent::__construct($this->message, $this->code, $previous);
    }

    public function getError(): string
    {
        return $this->error;
    }
}
