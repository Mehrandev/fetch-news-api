<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class ArticleDataInvalidException extends Exception
{

    public function __construct($message = 'Invalid data provided for article insertion', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report(): void
    {
        // ...
    }


}
