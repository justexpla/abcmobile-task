<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_change_his_settings()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->patchJson(route('api.v1.user.settings.update'), [
            'timezone' => $newTz = fake()->timezone,
            'language' => $newLang = 'ru',
        ])->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->hasAll(['data.timezone', 'data.language']));

        $this->assertEquals($user->timezone, $newTz);
        $this->assertEquals($user->lang, $newLang);
    }

    /**
     * @test
     */
    public function it_should_validate_timezone()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->patchJson(route('api.v1.user.settings.update'), [
            'timezone' => 'Ostania/Nowhere',
            'language' => 'en',
        ])->assertStatus(422)
            ->assertJsonValidationErrors('timezone');
    }

    /**
     * @test
     */
    public function it_should_validate_country_code()
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->patchJson(route('api.v1.user.settings.update'), [
            'timezone' => fake()->timezone,
            'language' => 'qq',
        ])->assertStatus(422)
            ->assertJsonValidationErrors('language');
    }

    /**
     * @test
     */
    public function a_user_cannot_change_settings_without_auth()
    {
        $user = User::factory()->create();

        $response = $this->patchJson(route('api.v1.user.settings.update'), [
            'timezone' => $newTz = fake()->timezone,
            'language' => $newLang = 'ru',
        ])->assertStatus(401);
    }
}
