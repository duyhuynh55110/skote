<?php
namespace App\Modules\Api\Repositories;

use App\Models\Category;
use Base\Repositories\Eloquent\Repository;

class CategoryRepository extends Repository {
    /**
     * Specify Model class name
     *
     * @return Category
     */
    public function model() {
        return Category::class;
    }
}
