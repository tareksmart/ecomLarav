<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
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
            'description'=>$this->faker->sentences(5,true),//اعمل داتا مزيفة ب5 جمل
            'logoImage'=>$this->faker->imageUrl(),
            'coverImage'=>$this->faker->imageUrl(),
        ];
    }
}
