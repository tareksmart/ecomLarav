<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(UserSeeder::class);
        //ستور فاكتورى تم استدعائه من موديل ال ستور ازاى عرفه؟ عرفه من المسمى
        Store::factory(3)->create();//اعمل 3 مخازن مزيف
        category::factory(5)->create();
        Product::factory(20)->create();
        //php artisan db:seed
    }
}
