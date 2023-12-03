<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticateHttpException extends HttpException
{
    public function __construct(protected $statusCode = STATUS_CODE_LOGIN_FAILED, protected $message = 'login failed.')
    {
        parent::__construct($statusCode, $message);
    }
}
