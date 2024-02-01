<?php

namespace App\Modules\Api\Repositories;

use App\Models\Product;
use Base\Repositories\Eloquent\Repository;
use Illuminate\Support\Facades\DB;

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
     * @param string $orderBy
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProducts(
        int $page,
        int $perPage,
        string $orderBy,
        array $columns = ['*'],
        array $filter = []
    ) {
        $query = $this->model->select($columns);

        // https://laravel.com/docs/10.x/queries#full-text-where-clauses
        // filter by search string
        $query->when(
            isset($filter['search']) && !empty($filter['search']),
            function ($q) use ($filter) {
                $q->whereFullText(['name_en', 'name_vi'], $filter['search']);
            }
        );

        // filter by categories list
        $query->when(
            isset($filter['category_slug']) && !empty($filter['category_slug']),
            function ($q) use ($filter) {
                $q->whereHas('categories', function ($q) use ($filter) {
                    $q->whereIn('slug_name', $filter['category_slug']);
                });
            }
        );

        // order by value
        $this->orderProductsListBy($query, $orderBy);

        // paginate
        return $query->paginate($perPage, [], 'page', $page);
    }

    /**
     * Get a product detail by slug_name
     *
     * @param string $slugName
     * @param array $columns
     * @return Product
     */
    public function getProductBySlugName(string $slugName, array $columns = ['*']) {
        return $this->model->select($columns)
        ->with([
            'brand:id,slug_name,name_en,name_vi,logo_file_name',
            'categories:id,slug_name,name_en,name_vi'
        ])
        ->where('slug_name', $slugName)
        ->first();
    }

    /**
     * Order products list by value
     *
     * @param $query
     * @param string $orderBy
     * @return void
     */
    private function orderProductsListBy(&$query, string $orderBy) {
        // order by newest
        $query->when(in_array($orderBy, [ORDER_BY_TOP_SELLING, ORDER_BY_POPULAR, ORDER_BY_NEWEST]), fn($q) => $q->orderByDesc('id'));

        // order by price; low to height
        $query->when($orderBy == ORDER_BY_LOW_TO_HEIGHT, fn($q) => $q->orderBy('item_price'));

        // order by price; height to low
        $query->when($orderBy == ORDER_BY_HEIGHT_TO_LOW, fn($q) => $q->orderByDesc('item_price'));
    }

    /**
     * Prepare products table for union
     *
     * @param string $searchText
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function unionProducts(string $searchText): \Illuminate\Database\Eloquent\Builder {
        return  $this->model
        ->select([
            'slug_name',
            'name_en',
            'name_vi',
            'image_file_name',
            'item_price',
            DB::raw('"' . UNION_TABLE_TYPE_PRODUCT . '" as row_type'),
        ])
        ->whereFullText(['name_en', 'name_vi'], $searchText);
    }
}
