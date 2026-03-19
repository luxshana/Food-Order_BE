<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class OtpTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
            'Confirm_password' => Hash::make('password123'),
        ]);
    }

    /**
     * Test OTP sending via login.
     */
    public function test_can_send_otp_via_login(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'OTP sent successfully',
                 ])
                 ->assertJsonStructure(['user_id']);

        $this->user->refresh();
        $this->assertNotNull($this->user->otp);
    }

    /**
     * Test OTP verification and login complete.
     */
    public function test_can_verify_otp_and_login(): void
    {
        // First login to generate OTP
        $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);
        
        $this->user->refresh();
        $otp = $this->user->otp;

        $response = $this->postJson('/api/verify-otp', [
            'user_id' => $this->user->id,
            'otp' => $otp,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'status' => 'success',
                     'message' => 'Login successful',
                 ])
                 ->assertJsonStructure(['token', 'user_info']);

        $this->user->refresh();
        $this->assertTrue($this->user->is_verified);
        $this->assertNull($this->user->otp);
    }

    /**
     * Test incorrect OTP verification.
     */
    public function test_cannot_verify_incorrect_otp(): void
    {
        $this->postJson('/api/login', [
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $response = $this->postJson('/api/verify-otp', [
            'user_id' => $this->user->id,
            'otp' => '000000',
        ]);

        $response->assertStatus(400)
                 ->assertJson([
                     'status' => 'error',
                     'message' => 'Invalid or expired OTP',
                 ]);
    }
}
