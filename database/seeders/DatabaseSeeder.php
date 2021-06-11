<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 100; $i > 0; $i--) {
            $product = Product::factory()->create();
            for ($j = rand(2, 4); $j > 0; $j--) {
                Attribute::factory()->create(['product_id' => $product->id]);
            }
        }
    }
}
