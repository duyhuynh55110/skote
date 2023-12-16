<?php declare(strict_types=1);

namespace App\GraphQL\Queries\Product;

use App\Modules\Api\Repositories\ProductRepository;

final class GetProductsQuery
{
    public function __construct(private ProductRepository $productRepo)
    {
    }

    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $page = $args['page'] ?? 1;
        $perPage = $args['first'];
        $filter = [
            'search' => $args['search'] ?? null,
        ];
        $columns = ['slug_name', 'name_en', 'name_vi', 'image_file_name', 'item_price'];

        return $this->productRepo->getProducts($page, $perPage, $columns, $filter);
    }
}
