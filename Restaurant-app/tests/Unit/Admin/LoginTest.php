<?php

namespace Tests\Unit\Admin;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testLoginForm()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

}
