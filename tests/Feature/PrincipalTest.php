<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PrincipalTest extends TestCase
{
    /** @test*/
    public function testBasicTest()
    {
        $response = $this->get('/')
            ->assertStatus(200);
    }
}
