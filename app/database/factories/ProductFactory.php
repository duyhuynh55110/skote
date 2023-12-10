<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Path to get files for run
     *
     * @var int
     */
    const DIR_PATH = "storage/seeder/products/*";

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nameEn = $this->faker->realText(40);

        // file list
        $files = glob(self::DIR_PATH);

        // list images available
        $fileNames = collect($files)->map(
            function ($file) {
                if (is_file($file)) {
                    return basename($file);
                }
            }
        );

        // product data
        $data = [
            'slug_name' => $nameEn,
            'name_en' => $nameEn,
            'name_vi' => $this->faker->realText(40),
            'image_file_name' => $fileNames[rand(0, count($fileNames) - 1)],
            'item_price' => rand(1, 100),
            'description' => '<p>'.$this->faker->realText(300).'</p>',
        ];

        if(!empty($data['image_file_name'])) {
            // 1. open & read file
            $filePath = storage_path('seeder/' . STORAGE_PATH_TO_PRODUCTS . $data['image_file_name']);
            $file = new File($filePath);
            $fileName = STORAGE_PATH_TO_PRODUCTS . $file->hashName();

            // 2. upload resize to storage
            uploadImageToStorage($file, $fileName, RESIZE_PRODUCT_WIDTH, RESIZE_PRODUCT_HEIGHT, $file->extension());

            // 3. update image_file_name field
            $data['image_file_name'] = $fileName;
        }

        return $data;
    }
}
