<?php

namespace Tests\Feature;

use App\Models\ArticleCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleCategoryTest extends TestCase
{

    public function test_fetch_article_categories()
    {
        $this->getJson('/api/article-categories')->assertStatus(200)->dump();
    }

    public function test_store_article_category_successfully()
    {
        $this->postJson('/api/article-categories', [
            'name' => 'Category',
        ])->assertStatus(201)->dump();
    }

    public function test_user_cannot_store_article_category()
    {
        $this->postJson('/api/article-categories', [
            'name' => 'Category',
        ])->assertStatus(401)->dump();
    }

    public function test_update_article_category_successfully()
    {
        $category = ArticleCategory::create([
            'name' => 'Category',
        ]);
        $this->putJson("/api/article-categories/{$category->id}", [
            'name' => 'Updated Category',
        ])->assertStatus(200)->dump();
    }

    public function test_user_cannot_update_article_category()
    {
        $category = ArticleCategory::create([
            'name' => 'Category',
        ]);
        $this->putJson("/api/article-categories/{$category->id}", [
            'name' => 'Updated Category',
        ])->assertStatus(401)->dump();
    }

    public function test_delete_article_category_successfully()
    {
        $category = ArticleCategory::create([
            'name' => 'Category',
        ]);
        $this->deleteJson("/api/article-categories/{$category->id}")->assertStatus(204)->dump();
    }

    public function test_article_category_cannot_be_stored_with_existing_name()
    {
        $category = ArticleCategory::create([
            'name' => 'Category',
        ]);
        $this->postJson('/api/article-categories', [
            'name' => 'Category',
        ])->assertStatus(422)->dump();
    }

    public function test_article_category_cannot_be_updated_with_existing_name()
    {
        $category = ArticleCategory::create([
            'name' => 'Category',
        ]);
        $this->putJson("/api/article-categories/{$category->id}", [
            'name' => 'Updated Category',
        ])->assertStatus(422)->dump();
    }

    public function test_store_article_category_without_name()
    {
        $this->postJson('/api/article-categories', [
            'name' => '',
        ])->assertStatus(422)->dump();
    }



    public function test_delete_not_found_article_category()
    {
        $this->deleteJson('/api/article-categories/1')->assertStatus(404)->dump();
    }

    public function test_update_not_found_article_category()
    {
        $this->putJson('/api/article-categories/1', [
            'name' => 'Updated Category',
        ])->assertStatus(404)->dump();
    }
}