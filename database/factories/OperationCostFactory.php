<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OperationCost>
 */
class OperationCostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->name,
            'profile'=>$this->faker->numberBetween('1','2'),
            'profile_type'=>$this->faker->numberBetween('1','7'),
            'create_by'=>$this->faker->numberBetween('1','3'),
            'department_id'=>$this->faker->numberBetween('1','3'),
            'cost'=>$this->faker->numberBetween('10','300'),
            'cost_method'=>'1',
            'start_from'=>$this->faker->dateTimeBetween('-1 years','now','asia/Kuala_Lumpur'),
            'end_from'=>$this->faker->dateTimeBetween('-1 years','now','asia/Kuala_Lumpur'),
        ];
    }
}
