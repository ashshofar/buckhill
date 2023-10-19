<?php

namespace App\Domain\Product\Controllers\Product;

use App\Domain\Product\BLL\Product\ProductBLLInterface;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiSuccessResponse;

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
