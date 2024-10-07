<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Source;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = \App\Models\Article::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'category_id' => Category::factory(),  // Generates a related Category
            'source_id' => Source::factory(),      // Generates a related Source
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
