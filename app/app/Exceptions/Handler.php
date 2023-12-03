<?php

namespace App\Exceptions;

use App\Traits\HandleErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use HandleErrorException;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Throwable $e
     * @return mixed
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        // If the request wants JSON (AJAX doesn't always want JSON)
        if ($request->expectsJson()) {
            return $this->customApiResponse($request, $e);
        }

        // Default to the parent class' implementation of handler
        return parent::render($request, $e);
    }

    /**
     * Return JSON format if request have content type is 'application/json'
     *
     * @param $request
     * @param Throwable $e
     * @return \Illuminate\Http\JsonResponse
     */
    private function customApiResponse($request, Throwable $e): \Illuminate\Http\JsonResponse
    {
        $e = $this->prepareException($e);

        switch (get_class($e)) {
            case ValidationException::class:
                return $this->renderValidateException($e, $request);
            case NotFoundHttpException::class:
                return $this->renderNotFoundException($e);
            case BadRequestHttpException::class:
                return $this->renderBadRequestException($e);
            case AuthenticateHttpException::class:
                return $this->renderUnauthenticatedException($e);
            case EmptyCartProductsHttpException::class:
                return $this->renderForbiddenException($e);
            default:
                return $this->renderServerErrorException($e);
        }
    }
}
