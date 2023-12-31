<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Modules\Api\Repositories\BrandRepository;
use App\Modules\Api\Repositories\ProductRepository;

final class GetSearchMultipleItems
{
    public function __construct(private ProductRepository $productRepo, private BrandRepository $brandRepo)
    {
    }

    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $page = $args['page'] ?? 1;
        $perPage = $args['first'] ?? DEFAULT_LIMIT_UNION_TABLE_RECORDS;
        $searchText = $args['search'];

        $unionProductQuery = $this->productRepo->unionProducts($searchText);

        return $this->brandRepo->unionSearchMultiples($unionProductQuery, $searchText, $page, $perPage);
    }
}
