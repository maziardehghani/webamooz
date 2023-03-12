<?php

namespace Modules\Front\Tests\Feature;

use Tests\TestCase;

class FrontTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_user_can_see_home_page()
    {
        $response = $this->get('/');
        $response->assertOk();
    }
}
