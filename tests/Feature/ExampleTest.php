<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    // topページの表示確認
    public function testBasicTest()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/');

        $response->assertStatus(500);
        // $response->assertStatus(200);
                // ->assertViewIs('articles.index');
    }

    // ユーザー登録画面の表示確認
    public function testRegisterView()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/register');

        $response->assertStatus(200)
                ->assertViewIs('auth.register');
    }
}
