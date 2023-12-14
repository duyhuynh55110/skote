<?php declare(strict_types=1);

namespace App\GraphQL\Queries\Category;

use App\Models\Category;
use App\Modules\Api\Repositories\CategoryRepository;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

final class GetCategoriesQuery
{
    public function __construct(private CategoryRepository $categoryRepo)
    {}

    /**
     * Return a value for the field.
     *
     * @param  null  $_ Usually contains the result returned from the parent field. In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @param  \Nuwave\Lighthouse\Support\Contracts\GraphQLContext  $context Arbitrary data that is shared between all fields of a single query.
     * @param  \GraphQL\Type\Definition\ResolveInfo  $resolveInfo Information about the query itself, such as the execution state, the field name, path to the field from the root, and more.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function __invoke($_, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        return $this->categoryRepo->all(['id', 'slug_name', 'name_en', 'name_vi', 'image_file_name']);
    }
}
