<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Throwable;

class ApiErrorResponse implements Responsable
{
    /**
     * @param string $message
     * @param int $code
     * @param Throwable|null $exception
     * @param array $headers
     */
    public function __construct(
        private readonly string $message = '',
        private readonly int $code = Response::HTTP_INTERNAL_SERVER_ERROR,
        private readonly ?Throwable $exception = null,
        private readonly array $headers = []
    ) {
    }

    /**
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request): \Symfony\Component\HttpFoundation\Response
    {
        $response = [
            'success' => false,
            'message' => $this->message,
            'data' => [],
            'errors' => ''
        ];

        if (! is_null($this->exception) && config('app.debug')) {
            $response['debug'] = [
                'message' => $this->exception->getMessage(),
                'file'    => $this->exception->getFile(),
                'line'    => $this->exception->getLine(),
                'trace'   => $this->exception->getTraceAsString()
            ];
        }

        return response()->json(
            $response,
            $this->code,
            $this->headers
        );
    }
}
