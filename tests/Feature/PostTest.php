<?php

namespace Feature;

use App\Services\PostService;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * Test Success Index Posts Page
     */
    public function test_index_page_success(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('post.index'))
            ->assertStatus(200)
            ->assertViewHas('items');
    }

    /**
     * Test Success Create Post page
     */
    public function test_create_page_success(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('post.create'))
            ->assertStatus(200);
    }

    /**
     * Test Success request to store post
     *
     * @throws \JsonException
     */
    public function test_store_request_success(): void
    {
        $this->actingAs($this->getUser())
            ->post(route('post.store'), [
                'name' => fake()->name(),
                'slug' => "test-post",
                'content' => fake()->text(),
            ])
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /**
     * Test Success Edit Post Page
     */
    public function test_edit_page_success(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('post.edit', [$this->getPostId()]))
            ->assertStatus(200);
    }

    /**
     * Test Success show post page
     */
    public function test_show_page_success(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('post.show', [$this->getPostId()]))
            ->assertStatus(200);
    }

    /**
     * Test Success Update post request
     *
     * @throws \JsonException
     */
    public function test_update_request_success(): void
    {
        $this->actingAs($this->getUser())
            ->put(route('post.update', [$this->getPostId()]), [
                'name' => fake()->name(),
                'slug' => "test-post",
                'content' => fake()->text(),
            ])
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /**
     * Test Update Post Request with validation errors
     *
     */
    public function test_update_request_with_validation_errors(): void
    {
        $this->validationErrorsTest(route('post.update', [$this->getPostId()]), 'put', [
            'name' => "n",
            'slug' => "s",
            'content' => "c",
        ], [
            "name" =>["The name field must be at least 3 characters."],
            "slug" => ["The slug field must be at least 3 characters."],
            "content" => ["The content field must be at least 3 characters."],
        ], $this->getUser());
    }

    /**
     * Test Update Post with access denied error (user not own this post)
     */
    public function test_update_request_access_denied_error(): void
    {
        $this->actingAs($this->getUser(2))
            ->put(route('post.update', [$this->getPostId()]), [
                'name' => fake()->name(),
                'slug' => fake()->slug(),
                'content' => fake()->text(),
            ])
            ->assertStatus(403);
    }

    /**
     * Test Success Destroy post
     */
    public function test_destroy_request_success(): void
    {
        $this->actingAs($this->getUser())
            ->delete(route('post.destroy', [$this->getPostId()]))
            ->assertStatus(302);
    }

    /**
     * Returns created test post id
     */
    protected function getPostId(): int|null
    {
        return (new PostService())->findBySlug('test-post')?->id;
    }
}
