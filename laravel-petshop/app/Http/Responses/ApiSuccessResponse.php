<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ApiSuccessResponse implements Responsable
{
    /**
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @param array $headers
     */
    public function __construct(
        private readonly mixed $data,
        private readonly string $message = '',
        private readonly int $code = Response::HTTP_OK,
        private readonly array $headers = []
    ) {
    }

    /**
     * @param $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request): \Symfony\Component\HttpFoundation\Response
    {
        return response()->json(
            [
                'success' => true,
                'message' => $this->message,
                'data' => $this->data,
                'errors' => ''
            ],
            $this->code,
            $this->headers
        );
    }
}
