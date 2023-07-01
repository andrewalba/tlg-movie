<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseHelper
{
    /**
     * @param array $data
     * @param int $code
     * @param array $headers
     * @param int $options
     * @return JsonResponse
     */
    private function apiResponse(array $data, int $code = 200, array $headers = [], int $options = 0): JsonResponse
    {
        return response()->json($data, $code, $headers, $options);
    }

    /**
     * @param $message
     * @param string|null $key
     * @return JsonResponse
     */
    public function responseNotFound($message, ?string $key = 'error'): JsonResponse
    {
        return $this->apiResponse(
            [
                'success' => false,
                $key => $this->modifyMessage($message)
            ],
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * @return JsonResponse
     */
    public function responseDestroyed(): JsonResponse
    {
        return $this->apiResponse(
            [
                'success' => true,
            ],
            Response::HTTP_NO_CONTENT
        );
    }

    /**
     * @param string|null $message
     * @return JsonResponse
     */
    public function responseForbidden(?string $message = null): JsonResponse
    {
        return $this->apiResponse(
            [
                'success' => false,
                'error' => $message ?? 'Forbidden'
            ], Response::HTTP_FORBIDDEN);
    }

    /**
     * @param $message
     * @param string|null $key
     * @return JsonResponse
     */
    public function responseException($message, ?string $key = 'message'): JsonResponse
    {
        $response = Response::HTTP_INTERNAL_SERVER_ERROR;
        if ( $message instanceof ValidationException ) {
            $response = Response::HTTP_UNPROCESSABLE_ENTITY;
        }
        return $this->apiResponse(
            [
                'success' => false,
                $key => $this->modifyMessage($message)
            ],
            $response
        );
    }

    /**
     * @param Exception|string $message
     * @return string
     */
    private function modifyMessage(Exception|string $message): string
    {
        return ($message instanceof Exception )? $message->getMessage() : $message;
    }

    /**
     * The request user was not found
     *
     * @return JsonResponse
     */
    public function responseUserNotFound(): JsonResponse
    {
        return $this->responseNotFound('User not found.');
    }
}
