<?php

namespace App\Exceptions;

use Exception;
use GraphQL\Error\ClientAware;
use GraphQL\Error\ProvidesExtensions;

class AuthenticateHttpException extends Exception implements ClientAware, ProvidesExtensions
{
    public function __construct(protected $message = 'login failed.', protected $statusCode = STATUS_CODE_LOGIN_FAILED)
    {
    }

    /**
     * Returns true when exception message is safe to be displayed to a client.
     */
    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * Data to include within the "extensions" key of the formatted error.
     *
     * @return array<string, mixed>
     */
    public function getExtensions(): array
    {
        return [
            'code' => STATUS_CODE_LOGIN_FAILED,
        ];
    }
}
