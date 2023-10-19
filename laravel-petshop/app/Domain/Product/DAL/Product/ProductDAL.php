<?php

namespace App\Domain\Product\DAL\Product;

use App\DomainUtils\BaseDAL\BaseDAL;
use App\Domain\Product\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @property Product model
 */
class ProductDAL extends BaseDAL implements ProductDALInterface
{
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Find product by uuid
     *
     * @param string $uuid
     * @return Product|null
     */
    public function findProductByUuid(string $uuid): Product|null
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    /**
     * Search product
     *
     * @return LengthAwarePaginator
     */
    public function searchProduct(): LengthAwarePaginator
    {
        $limit = request('limit');
        $desc = request('desc');
        $sortBy = 'title';

        if (in_array(request('sortBy'), Product::SORT_FIELD)) {
            $sortBy = request('sortBy');
        }

        $category = request('category');
        $title = request('title');
        $price = request('price');

        $product = $this->model->query()->with(['category', 'brand']);

        $product->when(!is_null($category), function ($q) use ($category) {
           return $q->whereHas('category', function ($cq) use ($category) {
               return $cq->where('title', 'LIKE', '%'.$category.'%');
           });
        });

        $product->when(!is_null($title), function ($q) use ($title) {
            return $q->where('title', 'LIKE', '%'.$title.'%');
        });

        $product->when(!is_null($price), function ($q) use ($price) {
            return $q->where('price', '<=', $price);
        });

        if ($desc) {
            $product->orderBy($sortBy, 'DESC');
        } else {
            $product->orderBy($sortBy, 'ASC');
        }

        return $product->paginate($limit);
    }
}

