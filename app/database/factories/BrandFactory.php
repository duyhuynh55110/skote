<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Path to get files for run
     *
     * @var int
     */
    const DIR_PATH = "storage/seeder/brands/*";

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
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

        // brand data
        $nameEn = $this->faker->realText(30);
        $data = [
            'slug_name' => $nameEn,
            'name_en' => $nameEn,
            'name_vi' => $this->faker->realText(30),
            'logo_file_name' => $fileNames[rand(0, count($fileNames) - 1)],
        ];

        if(!empty($data['logo_file_name'])) {
            // 1. open & read file
            $filePath = storage_path('seeder/' . STORAGE_PATH_TO_BRANDS . $data["logo_file_name"]);
            $file = new File($filePath);
            $fileName = STORAGE_PATH_TO_BRANDS . $file->hashName();

            // 2. upload resize to storage
            uploadImageToStorage($file, $fileName, RESIZE_BRAND_WIDTH, RESIZE_BRAND_HEIGHT, $file->extension());

            // 3. update image_file_name field
            $data['logo_file_name'] = $fileName;
        }

        return $data;
    }
}
