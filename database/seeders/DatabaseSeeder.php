<?php
declare(strict_types=1);

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    private int $attribute_id = 0;

    private function attribute_id()
    {
        $this->attribute_id++;
        return $this->attribute_id;
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id' => 1,
            'name' => 'Piens',
            'description' => 'Ļoti veselīgs!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 1,
            'key' => 'Tauku saturs',
            'value' => '2,5%',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 1,
            'key' => 'Krāsa',
            'value' => 'Balta',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 2,
            'name' => 'Galds',
            'description' => 'Datora galds "Rīga"',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 2,
            'key' => 'Augstums',
            'value' => '750mm',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 2,
            'key' => 'Platums',
            'value' => '1200mm',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 2,
            'key' => 'Dziļums',
            'value' => '600mm',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 2,
            'key' => 'Krāsa',
            'value' => 'Melna',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 2,
            'key' => 'Ražots',
            'value' => 'Latvijā',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Konfekte',
            'description' => '"Vāverīte"',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 3,
            'key' => 'Svars',
            'value' => '10g',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 3,
            'key' => 'Sastāvs',
            'value' => 'Šokolāde, rieksti',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 3,
            'key' => 'Garšīga',
            'value' => 'Jā!',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 4,
            'name' => 'Telefons',
            'description' => 'iPhone 13',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 4,
            'key' => 'Baterija',
            'value' => '2500mAh',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 4,
            'key' => 'Tips',
            'value' => 'Skārienjūtīgs',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 4,
            'key' => 'Cena',
            'value' => '1500€',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'id' => 5,
            'name' => 'Automašīna',
            'description' => 'Nissan "Qashqai"',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 5,
            'key' => 'Motora tilpums',
            'value' => '1200cm^3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 5,
            'key' => 'Jauda',
            'value' => '115kW',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 5,
            'key' => 'Riepu izmērs',
            'value' => '215/60R17',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('attributes')->insert([
            'id' => $this->attribute_id(),
            'product_id' => 5,
            'key' => 'Degvielas patēriņš',
            'value' => '5,2L',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
