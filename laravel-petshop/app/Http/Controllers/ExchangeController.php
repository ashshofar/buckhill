<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeRequest;
use App\Http\Responses\ApiSuccessResponse;
use Ashshofar\Exchange\Exchange;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/exchange",
 *     summary="Exchange rate",
 *     tags={"Exchange Package"},
 *    @OA\Parameter(
 *          name="amount",
 *          in="query",
 *          description="amount",
 *          required=true,
 *          @OA\Schema(type="integer")
 *    ),
 *    @OA\Parameter(
 *         name="currency",
 *         in="query",
 *         description="currency",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
 *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
 *     @OA\Response(response=422, description="Unprocessable Entity", @OA\JsonContent()),
 *     @OA\Response(response=404, description="Page not found", @OA\JsonContent()),
 *     @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
 * )
 */
class ExchangeController extends Controller
{
    public function __construct(public Exchange $exchange)
    {}

    /**
     * @param ExchangeRequest $request
     * @return ApiSuccessResponse
     */
    public function __invoke(ExchangeRequest $request): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->exchange->convert(
                $request->input('amount'),
                $request->input('currency')
            ),
            'Exchange result'
        );
    }
}
