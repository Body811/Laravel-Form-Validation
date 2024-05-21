<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use http\Env\Request;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    public function test_store()
    {
        $response = $this->post('/store');
        $response->assertSessionDoesntHaveErrors(['success' => __('msg.Register Successfully')]);
    }


}
