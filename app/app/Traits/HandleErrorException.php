<?php

namespace App\Traits;

use App\Exceptions\AuthenticateHttpException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait HandleErrorException
{
    /**
     *  Response validate exception json format
     *
     * @param ValidationException $e
     * @param $request
     * @return JsonResponse
     */
    private function renderValidateException(ValidationException $e, $request): JsonResponse
    {
        $e = $this->convertValidationExceptionToResponse($e, $request);

        // Only return first error message
        $errors = $e->original['errors'];
        $firstErrorKey = array_keys($errors)[0];
        $firstErrorMessage = array_values($errors[$firstErrorKey])[0];

        return response()->json([
            'message' => $firstErrorMessage,
            'errors' => $this->convertApiErrors($errors),
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @return array
     */
    private function convertApiErrors($errors)
    {
        $result = [];
        foreach ($errors as $k => $error) {
            $result[] = [
                'field' => $k,
                'message' => $error[0],
            ];
        }

        return $result;
    }

    /**
     * Response not found exception
     *
     * @param NotFoundHttpException $e
     * @return JsonResponse
     */
    private function renderNotFoundException(NotFoundHttpException $e): JsonResponse
    {
        return response()->json([
            'code' => JsonResponse::HTTP_NOT_FOUND,
            'message' => $e->getMessage() ? $e->getMessage() : 'not found.',
        ], JsonResponse::HTTP_NOT_FOUND);
    }

    /**
     * Response bad request exception
     *
     * @param BadRequestHttpException $e
     * @param $code
     * @return JsonResponse
     */
    private function renderBadRequestException(BadRequestHttpException $e, $code = null): JsonResponse
    {
        return response()->json([
            'code' => $code ?? JsonResponse::HTTP_BAD_REQUEST,
            'message' => $e->getMessage() ? $e->getMessage() : 'bad request.',
        ], JsonResponse::HTTP_BAD_REQUEST);
    }

    /**
     * Response server error exception
     *
     * @param $e
     * @return JsonResponse
     */
    private function renderServerErrorException($e): JsonResponse
    {
        $response = [
            'message' => $e->getMessage() ? $e->getMessage() : 'server error.',
        ];

        if (config('app.debug')) {
            if (method_exists($e, 'getTrace')) {
                $response['trace'] = $e->getTrace();
            }
        }

        return response()->json($response, JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Response unauthenticated exception
     *
     * @param $e
     * @return JsonResponse
     */
    private function renderUnauthenticatedException(AuthenticateHttpException $e): JsonResponse
    {
        return response()->json([
            'code' => $e->getStatusCode(),
            'message' => $e->getMessage(),
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }

    /**
     * Response forbidden exception
     *
     * @param $e
     * @return JsonResponse
     */
    private function renderForbiddenException($e): JsonResponse
    {
        return response()->json([
            'code' => $e->getStatusCode(),
            'message' => $e->getMessage(),
        ], JsonResponse::HTTP_FORBIDDEN);
    }
}
