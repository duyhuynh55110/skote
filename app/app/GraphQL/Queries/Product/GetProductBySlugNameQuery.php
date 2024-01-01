<?php declare(strict_types=1);

namespace App\GraphQL\Queries\Product;

use App\Modules\Api\Repositories\ProductRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetProductBySlugNameQuery
{
    public function __construct(private ProductRepository $productRepo)
    {}

    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $product = $this->productRepo->getProductBySlugName(
            $args['slug_name'],
            ['id', 'brand_id', 'slug_name', 'name_en', 'name_vi', 'image_file_name', 'item_price', 'description', 'summary_rating', 'count_rating']
        );

        return $product;
    }
}
