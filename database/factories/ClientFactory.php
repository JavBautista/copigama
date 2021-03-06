<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
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
            'name'=>$this->faker->name(),
            'company'=>$this->faker->company(),
            'email'=>$this->faker->email(),
            'movil'=>$this->faker->phoneNumber(),
            'address'=>$this->faker->address(),
        ];
    }
}
