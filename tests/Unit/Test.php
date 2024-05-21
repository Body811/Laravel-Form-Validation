<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Test extends TestCase
{
    use RefreshDatabase;
    public function test_create()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }
    public function test_form_submit_without_fullname()
    {
        $response = $this->post('/store');
        $response->assertSessionHasErrors(['fullName'=>__('msg.full_name_required')]);
    }
    public function test_form_submit_with_invalid_email()
    {
        $response = $this->post('/store',['email' => 'email']);
        $response->assertSessionHasErrors(['email' => __('msg.email_regex')]);
    }

    public function test_form_submit_with_unmatched_password_confirmation()
    {
        $response = $this->post('/store', ['password' => 'password', 'password_confirmation' => 'password1']);
        $response->assertSessionHasErrors(['password' => __('msg.password_confirmed')]);
    }
}
