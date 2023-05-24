<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VcVirtualMachine>
 */
class VcVirtualMachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'vm_object_id'=>$this->faker->randomDigit('4'),
            'vm_hostname'=>$this->faker->randomElement(['sgb','kpg','bng']).$this->faker->randomElement(['prod', 'dev', 'uat']).$this->faker->randomDigit(),
            'vcpu' =>$this->faker->randomElement(['2', '4', '6', '8', '10', '16', '32']),
            'vmem'=>$this->faker->randomElement(['2', '4', '6', '8', '10', '16', '32']),
            'vstorage'=>$this->faker->randomElement(['100', '200']),
            'power_status'=>$this->faker->randomElement(['1', '0']),
        ];
    }
}
