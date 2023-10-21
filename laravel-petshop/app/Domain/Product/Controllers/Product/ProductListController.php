<?php

namespace App\Domain\Product\Controllers\Product;

use App\Domain\Product\BLL\Product\ProductBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;
use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/v1/products",
 *     summary="Get product list",
 *     tags={"Product"},
 *     security={{ "bearerAuth": {} }},
 *     @OA\Parameter(
 *          name="title",
 *          in="query",
 *          description="Product title",
 *          required=false,
 *          @OA\Schema(type="string")
 *    ),
 *     @OA\Parameter(
 *          name="price",
 *          in="query",
 *          description="product price",
 *          required=false,
 *          @OA\Schema(type="integer")
 *    ),
 *    @OA\Parameter(
 *          name="sortBy",
 *          in="query",
 *          description="sortBy",
 *          required=false,
 *          @OA\Schema(type="string")
 *    ),
 *    @OA\Parameter(
 *          name="limit",
 *          in="query",
 *          description="item limit",
 *          required=false,
 *          @OA\Schema(type="integer")
 *    ),
 *    @OA\Parameter(
 *         name="desc",
 *         in="query",
 *         description="desc",
 *         required=false,
 *         @OA\Schema(type="boolean")
 *     ),
 *     @OA\Response(response=200, description="OK", @OA\JsonContent()),
 *     @OA\Response(response=401, description="Unauthorized", @OA\JsonContent()),
 *     @OA\Response(response=422, description="Unprocessable Entity", @OA\JsonContent()),
 *     @OA\Response(response=404, description="Page not found", @OA\JsonContent()),
 *     @OA\Response(response=500, description="Internal server error", @OA\JsonContent())
 * )
 */
class ProductListController extends Controller
{
    public function __construct(public ProductBLLInterface $productBLL)
    {}

    /**
     * @return ApiSuccessResponse
     */
    public function __invoke(): ApiSuccessResponse
    {
        return new ApiSuccessResponse(
            $this->productBLL->getListProduct(),
            'product list'
        );
    }
}
