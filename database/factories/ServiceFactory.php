<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'active'=>1,
            'name'=>$this->faker->word(),
            'description'=>$this->faker->sentence(),
            'price'=>$this->faker->randomFloat(2,100,9999),
        ];
    }
}