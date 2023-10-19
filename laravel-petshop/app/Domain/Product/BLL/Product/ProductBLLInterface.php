<?php

namespace App\Domain\Product\BLL\Product;

use App\DomainUtils\BaseBLL\BaseBLLInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ProductBLLInterface extends BaseBLLInterface
{
    /**
     * Search product
     *
     * @return LengthAwarePaginator
     */
    public function getListProduct(): LengthAwarePaginator;
}
