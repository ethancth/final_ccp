<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $domain=$this->faker->domainName();
        return [
            'name' => $this->faker->company(),
            'domain'=>$domain,
            'master_id'=>$this->faker->numberBetween('1','3'),
            'slug'=>$domain

        ];
    }
}
