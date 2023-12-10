<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Total rows will be create when run seed
     *
     * @var int
     */
    const COUNT = 50;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // list all brands in database
        $brandIds = Brand::limit(5)->get()->pluck('id')->all();
        $categoryIds = Category::get()->pluck('id')->all();

        $products = Product::factory()->count(self::COUNT)->create([
            'brand_id' => Arr::random($brandIds),
        ]);

        // Map products to add relation products - categories
        $products->map(
            function ($product) use ($categoryIds) {
                // Create random category product
                $product->categories()->sync(
                    [
                        Arr::random($categoryIds) => [
                            'created_by' => CREATED_BY_SYSTEM,
                            'created_at' => Carbon::now(),
                            'updated_by' => CREATED_BY_SYSTEM,
                            'updated_at' => Carbon::now(),
                        ],
                    ]
                );
            }
        );
    }
}
