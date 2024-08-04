<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class megustaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "usuario" => rand(1,10),
            "post_id" => rand(1,10),
            "comentaio" => rand(1,10)
        ];
    }
}