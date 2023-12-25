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
        $query = $this->model;

        // filter by search string
        $query->when(
            isset($filter['search']) && !empty($filter['search']),
            function ($q) use ($filter) {
                $q->whereFullText(['name_en', 'name_vi'], $filter['search']);
            }
        );

        return $query->orderBy('id', 'DESC')->paginate($perPage, $columns, 'page', $page);
    }

    /**
     * Get a product detail by slug_name
     *
     * @param string $slugName
     * @param array $columns
     * @return Product
     */
    public function getProductBySlugName(string $slugName, array $columns = ['*']) {
        return $this->model->select($columns)->where('slug_name', $slugName)->first();
    }
}
