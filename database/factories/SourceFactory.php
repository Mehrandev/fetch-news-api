<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Source>
 */
class SourceFactory extends Factory
{
    protected $model = \App\Models\Source::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'url' => $this->faker->url,
        ];
    }
}
