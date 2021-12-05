<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \FakerRestaurant\Provider\id_ID\Restaurant($this->faker));

        return [
            'product_name' => $this->faker->unique()->foodName(),
            'product_price' => $this->faker->randomNumber(5),
            'product_qty' => $this->faker->randomNumber(2),
        ];
    }
}
