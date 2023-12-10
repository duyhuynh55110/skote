<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_en' => 'Milks and Dairies',
                'name_vi' => 'Sữa và các sản phẩm từ sữa',
            ],
            [
                'name_en' => 'Clothing & beauty',
                'name_vi' => 'Quần áo & làm đẹp',
            ],
            [
                'name_en' => 'Pet toy',
                'name_vi' => 'Đồ chơi thú cưng',
            ],
            [
                'name_en' => 'Baking material',
                'name_vi' => 'Nguyên liệu làm bánh',
            ],
            [
                'name_en' => 'Fresh Fruit',
                'name_vi' => 'Hoa quả tươi',
            ],
            [
                'name_en' => 'Cake & Milk',
                'name_vi' => 'Bánh & Sữa',
            ],
            [
                'name_en' => 'Coffee & Teas',
                'name_vi' => 'Cà phê & Trà',
            ],
            [
                'name_en' => 'Wines & Drinks',
                'name_vi' => 'Rượu & Đồ uống',
            ],
            [
                'name_en' => 'Fresh Seafood',
                'name_vi' => 'Hải sản tươi sống',
            ],
            [
                'name_en' => 'Fast Food',
                'name_vi' => 'Thức ăn nhanh',
            ],
            [
                'name_en' => 'Vegetables',
                'name_vi' => 'Rau',
            ],
            [
                'name_en' => 'Bread & Juice',
                'name_vi' => 'Bánh mì & nước trái cây',
            ],
            [
                'name_en' => 'Pet Food',
                'name_vi' => 'Thức ăn cho thú cưng',
            ],
            [
                'name_en' => 'Diet Foods',
                'name_vi' => 'Thực phẩm ăn kiêng',
            ],
        ];

        try {
            DB::beginTransaction();

            $uploadedFiles = [];

            // upload image to storage
            foreach ($data as $index => &$dt) {
                // insert method not call mutator from Model that why must slugify here
                $dt['slug_name'] = slugify($dt['name_en']);
                $dt['created_by'] = $dt['updated_by'] = CREATED_BY_SYSTEM;
                $dt['created_at'] = $dt['updated_at'] = Carbon::now();

                // 1. open & read file
                $position = $index + 1;
                $filePath = storage_path('seeder/'.STORAGE_PATH_TO_CATEGORIES. "icon-{$position}.png");
                $file = new File($filePath);
                $fileName = STORAGE_PATH_TO_CATEGORIES.$file->hashName();

                // 2. upload resize to storage
                uploadImageToStorage($file, $fileName, RESIZE_CATEGORY_WIDTH, RESIZE_CATEGORY_HEIGHT, $file->extension());
                $uploadedFiles[] = $fileName;

                // 3. update image_file_name field
                $dt['image_file_name'] = $fileName;
            }

            // insert data to brands table
            Category::insert($data);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            // Remove all uploaded files
            collect($uploadedFiles)->map(
                fn (string $fileName) => deleteImageFromStorage($fileName)
            );

            throw $e;
        }
    }
}
