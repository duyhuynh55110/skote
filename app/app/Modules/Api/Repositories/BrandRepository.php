<?php
namespace App\Modules\Api\Repositories;

use App\Models\Brand;
use Base\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BrandRepository extends Repository {
    /**
     * Specify Model class name
     *
     * @return Brand
     */
    public function model() {
        return Brand::class;
    }

    /**
     * Prepare brands table for union
     *
     * @param Illuminate\Database\Eloquent\Builder $unionProductsQuery
     * @param string $searchText
     * @param int $page
     * @param int $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function unionSearchMultiples(
        Builder $unionProductQuery,
        string $searchText,
        int $page,
        int $perPage
    ) {
        $unionBrands = $this->model
        ->select([
            'slug_name',
            'name_en',
            'name_vi',
            'logo_file_name',
            DB::raw('"' . UNION_TABLE_TYPE_BRAND . '" as row_type'),
        ])
        ->whereFullText(['name_en', 'name_vi'], $searchText);

        // Paginate union table
        $paginate = $unionBrands->union($unionProductQuery)->paginate($perPage, [], 'page', $page);

        // Modify the data in the collection
        $records = $paginate->items();
        $modifiedItems = collect($records)->map(function (\App\Models\Product|\App\Models\Brand $item) {
            return [
                'slug_name' => $item->slug_name,
                'name' => $item->name,
                'full_path_image' => $item instanceof \App\Models\Product ? $item->full_path_image : $item->full_path_logo,
                'row_type' => $item->row_type,
            ];
        });

        // Replace the original items in the paginator with the modified ones
        $paginate->setCollection($modifiedItems);

        return $paginate;
    }
}
