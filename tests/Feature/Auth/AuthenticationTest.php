<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_authenticate_with_valid_credentials()
    {
        $email = fake()->email;
        $password = fake()->password;

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $loginResponse = $this->postJson(route('api.v1.auth.login'), [
            'email' => $email,
            'password' => $password
        ]);

        $loginResponse->assertStatus(200)
            ->assertJsonStructure(['data' => ['access_token', 'token_type', 'expires_in', 'user']]);

        // Check if token is correct
        $accessToken = $loginResponse->decodeResponseJson()['data']['access_token'];

        $this->getJson(route('api.v1.auth.me'), [
            'Authorization' => sprintf("Bearer %s", $accessToken)
        ])->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_user_cannot_authenticate_with_invalid_credentials()
    {
        $email = fake()->email;
        $password = fake()->password;

        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->postJson(route('api.v1.auth.login'), [
            'email' => $email,
            'password' => fake()->password,
        ])->assertStatus(401);
    }

    /**
     * @test
     */
    public function a_user_cannot_authenticate_with_invalid_email()
    {
        $this->postJson(route('api.v1.auth.login'), [
            'email' => 'in valid@email',
            'password' => fake()->password,
        ])->assertStatus(422)
            ->assertJsonValidationErrorFor('email');
    }

    /**
     * @test
     */
    public function a_user_cannot_authenticate_without_password()
    {
        $this->postJson(route('api.v1.auth.login'), [
            'email' => fake()->email,
        ])->assertStatus(422)
            ->assertJsonValidationErrorFor('password');
    }
}
