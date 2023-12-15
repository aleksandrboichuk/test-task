<?php

namespace Feature;

use App\Services\PostService;
use App\Services\UserService;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Test Success Index Posts Page
     */
    public function test_index_page_success(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('user.index'))
            ->assertStatus(200)
            ->assertViewHas('items');
    }

    /**
     * Test Success Create Post page
     */
    public function test_create_page_success(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('user.create'))
            ->assertStatus(200);
    }

    /**
     * Test Success request to store user
     *
     * @throws \JsonException
     */
    public function test_store_request_success(): void
    {
        $this->actingAs($this->getUser())
            ->post(route('user.store'), [
                'name' => "Test User",
                'email' => "test-email@example.com",
                'password' => "password",
                'password_confirmation' => "password",
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
            ->get(route('user.edit', [$this->getUserId()]))
            ->assertStatus(200);
    }

    /**
     * Test Success show user page
     */
    public function test_show_page_success(): void
    {
        $this->actingAs($this->getUser())
            ->get(route('user.show', [$this->getUserId()]))
            ->assertStatus(200);
    }

    /**
     * Test Success Update user request
     *
     * @throws \JsonException
     */
    public function test_update_request_success(): void
    {
        $this->actingAs($this->getUser())
            ->put(route('user.update', [$this->getUserId()]), [
                'name' => "Test User Update",
                'email' => "test-email@example.com",
                'password' => "password2",
                'password_confirmation' => "password2",
            ])
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    /**
     * Test Update user Request with validation errors
     *
     */
    public function test_update_request_with_validation_errors(): void
    {
        $this->validationErrorsTest(route('user.update', [$this->getUserId()]), 'put', [
            'name' => "n",
            'email' => "s",
            'password' => "c",
        ], [
            "name" => [
               "The name field must be at least 3 characters."
            ],
            "email" => [
                "The email field must be a valid email address.",
                "The email field format is invalid."
            ],

            "password" => [
                "The password field must be at least 3 characters."
            ]
        ], $this->getUser());
    }

    /**
     * Test Success Destroy user
     */
    public function test_destroy_request_success(): void
    {
        $this->actingAs($this->getUser())
            ->delete(route('user.destroy', [$this->getUserId()]))
            ->assertStatus(302);
    }

    /**
     * Returns created test user id
     */
    protected function getUserId(): int|null
    {
        return (new UserService())->findByEmail('test-email@example.com')?->id;
    }
}
