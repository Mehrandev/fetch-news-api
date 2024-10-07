<?php

namespace Tests\Article;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Unit\Services\TestCase;

class ListArticlesTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_list_all_articles()
    {
        $category = Category::factory()->create();
        $source = Source::factory()->create();

        // Create some articles
        Article::factory(10)->create([
            'category_id' => $category->id,
            'source_id' => $source->id,
        ]);

        $response = $this->getJson('/api/v1/articles');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    'data' => [   // Modify to access the nested 'data' array
                        '*' => [
                            'id',
                            'title',
                            'content',
                            'category' => [
                                'id',
                                'name'
                            ],
                            'source' => [
                                'id',
                                'name'
                            ],
                            'created_at'
                        ]
                    ],
                    'pagination' => [
                        'total',
                        'count',
                        'per_page',
                        'current_page',
                        'total_pages'
                    ]
                ]
            ]);
    }
}
