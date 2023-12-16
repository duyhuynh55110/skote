<?php

namespace App\Modules\Api\Repositories;

use App\Models\Product;
use Base\Repositories\Eloquent\Repository;

class ProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return Product
     */
    public function model()
    {
        return Product::class;
    }

    /**
     * Get products list response paginate
     *
     * @param int $page
     * @param int $limit
     * @param array $
     * @param array $filter
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProducts(
        int $page,
        int $perPage,
        array $columns = ['*'],
        array $filter = []
    ) {
        // https://laravel.com/docs/10.x/queries#full-text-where-clauses
        return $this->model
        ->whereFullText(['name_en', 'name_vi'], $filter['search'] ?? null)
        ->orderBy('id', 'DESC')
        ->paginate($perPage, $columns, 'page', $page);
    }
}
