<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\category;
use App\Models\Store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name=$this->faker->words(2,true);//عمل داتا مزيفة من كلمتين نص
        return [
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->sentences(5),//اعمل داتا مزيفة ب5 جمل
            'image'=>$this->faker->imageUrl(),
            'price'=>$this->faker->randomFloat(1,1,499),//اعمل اسعار عشوائية عدد عشرى واحد من 1 الى 499
            'compare_price'=>$this->faker->randomFloat(1,500,999),
            'category_id'=>category::inRandomOrder()->first()->id,//هات عدد سجلات اقسام عشوائى اختر اول سجل خد كوده
            'featured'=>rand(0,1),
            'store_id'=>Store::inRandomOrder()->first()->id
        ];
    }
}
