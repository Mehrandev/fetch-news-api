<?php

namespace Tests\Unit\Article;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Unit\Services\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function an_article_belongs_to_a_category()
    {
        $category = Category::factory()->create();
        $article = Article::factory()->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Category::class, $article->category);
    }

    #[Test]
    public function an_article_belongs_to_a_source()
    {
        $source = Source::factory()->create();
        $article = Article::factory()->create(['source_id' => $source->id]);

        $this->assertInstanceOf(Source::class, $article->source);
    }
}
