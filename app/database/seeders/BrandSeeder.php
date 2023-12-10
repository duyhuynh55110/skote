<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Total rows will be create when run seed
     *
     * @var int
     */
    const COUNT = 30;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random brands
        Brand::factory(self::COUNT)->create();
    }
}
