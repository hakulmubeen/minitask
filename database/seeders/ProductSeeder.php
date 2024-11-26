<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $products = [
            [
                'name' => 'Laptop',
                'product_id' => 'P1001',
                'price' => 1200.00,
                'tax' => 10.0,
                'available_qty' => 50,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Smartphone',
                'product_id' => 'P1002',
                'price' => 800.00,
                'tax' => 8.5,
                'available_qty' => 100,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Headphones',
                'product_id' => 'P1003',
                'price' => 250.00,
                'tax' => 5.0,
                'available_qty' => 200,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Monitor',
                'product_id' => 'P1004',
                'price' => 300.00,
                'tax' => 7.0,
                'available_qty' => 80,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        // Insert data into the database
        DB::table('products')->insert($products);
    }
}
