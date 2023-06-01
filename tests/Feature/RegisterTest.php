<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * @TODO: добавить тесты для проверки пароля
 *
 * Class RegisterTest
 * @package Tests\Feature
 */
class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_register()
    {
        $data = [
            'email' => $email = fake()->email,
            'password' => 'sB9eJx8H',
            'password_confirmation' => 'sB9eJx8H',
        ];

        $this->assertDatabaseMissing('users', ['email' => $email]);

        $this->json('POST', route('api.v1.register'), $data)
            ->assertStatus(201);

        $this->assertDatabaseHas('users', ['email' => $email]);
    }

    /**
     * @test
     */
    public function a_user_cannot_register_without_email()
    {
        $data = [
            'password' => 'sB9eJx8H',
            'password_confirmation' => 'sB9eJx8H',
        ];

        $this->json('POST', route('api.v1.register'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('email');
    }

    /**
     * @test
     */
    public function a_user_cannot_register_without_password()
    {
        $data = [
            'email' => $email = fake()->email,
        ];

        $this->json('POST', route('api.v1.register'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('password');
    }

    /**
     * @test
     */
    public function a_user_cannot_register_without_password_confirmation()
    {
        $data = [
            'email' => $email = fake()->email,
            'password' => 'sB9eJx8H',
        ];

        $this->json('POST', route('api.v1.register'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('password');
    }

    /**
     * @test
     */
    public function a_user_cannot_register_with_duplicate_email()
    {
        $email = fake()->email;

        $user = User::factory()->create(['email' => $email]);

        $data = [
            'email' => $email,
            'password' => 'sB9eJx8H',
            'password_confirmation' => 'sB9eJx8H',
        ];

        $this->json('POST', route('api.v1.register'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('email');
    }

    /**
     * @test
     */
    public function a_user_cannot_register_with_invalid_email()
    {
        $data = [
            'email' => 'in valid@email',
            'password' => 'sB9eJx8H',
            'password_confirmation' => 'sB9eJx8H',
        ];

        $this->json('POST', route('api.v1.register'), $data)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('email');
    }

    /**
     * @test
     */
    public function it_has_a_valid_response_structure()
    {
        $data = [
            'email' => $email = fake()->email,
            'password' => 'sB9eJx8H',
            'password_confirmation' => 'sB9eJx8H',
        ];

        $response = $this->json('POST', route('api.v1.register'), $data);

        $response->assertStatus(201);

        $response->assertJson(fn (AssertableJson $json) =>
            $json->hasAll(['data.id', 'data.email'])
                ->whereType('data.id', 'string')
        );
    }

    /**
     * @test
     */
    public function it_sends_email_after_registration()
    {
        // @TODO
    }
}
