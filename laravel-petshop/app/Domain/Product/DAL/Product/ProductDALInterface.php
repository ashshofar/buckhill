<?php

namespace App\Domain\Product\DAL\Product;

use App\Domain\Product\Models\Product;
use App\DomainUtils\BaseDAL\BaseDALInterface;

interface ProductDALInterface extends BaseDALInterface
{
    /**
     * Find product by uuid
     *
     * @param string $uuid
     * @return Product|null
     */
    public function findProductByUuid(string $uuid): Product|null;
}
