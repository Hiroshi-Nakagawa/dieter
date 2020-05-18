<?php

namespace Tests\Feature;

use App\User;
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

        $response->assertStatus(200)
                ->assertViewIs('articles.index');
    }

    // ユーザー登録画面の表示確認
    public function testRegisterView()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/register');

        $response->assertStatus(200)
                ->assertViewIs('auth.register');
    }

    // ログイン
    public function testLoginView()
    {
        $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs(User::find(1))
                    ->get('/');

        $response->assertStatus(200)
                ->assertSee('投稿する');
    }

    // ログアウト
    public function testLogoutView()
    {
        $this->withoutExceptionHandling();
        // ログイン状態でログアウトしたら…
        $response = $this
                    ->actingAs(User::find(1))
                    ->post(route('logout'));
        
        // 正常にリダイレクトされているか
        $response->assertRedirect('/');

        // ユーザーが認証されていないことを確認
        $this->assertGuest();
    }
}
