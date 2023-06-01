<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserSettingsTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function a_user_can_change_his_settings() 
    {
        
    }
    
    /**
     * @test
     */
    public function it_should_validate_timezone() 
    {
        
    }
    
    /**
     * @test
     */
    public function it_should_validate_country_code() 
    {
        
    }
}
