<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Product;

final class GetProduct
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): Product
    {
        // TODO implement the resolver
        return Product::select('id', 'name_en', 'name_vi')->find($args['slug_name']);
    }
}
