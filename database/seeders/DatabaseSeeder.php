<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Stock;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            OwnerSeeder::class,
            ShopSeeder::class,
            ImageSeeder::class,
            CategorySeeder::class,
            UserSeeder::class,
            // ProductSeeder::class,
            // StockSeeder::class
        ]);
        // 先に上のcallメソッドでリレーションを作成しているため、
        // その後にダミーデータを作成する必要がある
            Product::factory(100)->create();
            Stock::factory(100)->create();
    }
}
