<?php

namespace Tests\Feature;

use App\Article;
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
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }
     // topページの表示確認
    public function testBasicTest()
    {
        // $this->withoutExceptionHandling();
        $response = $this->get('/');

        $response->assertStatus(200)
                ->assertViewIs('articles.index');
    }

    // ユーザー登録画面の表示確認
    public function testRegisterView()
    {
        // $this->withoutExceptionHandling();
        $response = $this->get('/register');

        $response->assertStatus(200)
                ->assertViewIs('auth.register');
    }

    // ログイン
    public function testLoginView()
    {
        // $this->withoutExceptionHandling();
        $response = $this
                    ->actingAs(User::find(1))
                    ->get('/');

        $response->assertStatus(200)
                ->assertSee('投稿する');
    }

    // ログアウト
    public function testLogoutView()
    {
        // $this->withoutExceptionHandling();
        // ログイン状態でログアウトしたら…
        $response = $this
                    ->actingAs(User::find(1))
                    ->post(route('logout'));
        
        // 正常にリダイレクトされているか
        $response->assertRedirect('/');

        // ユーザーが認証されていないことを確認
        $this->assertGuest();
    }

    // 記事投稿画面
    public function testArticlesCreateView()
    {
        $response = $this
                    ->actingAs(User::find(1))
                    ->get(route('articles.create'));
        
        $response->assertStatus(200);
    }

    // 記事更新画面
    public function testArticleEditView()
    {
        $response = $this
                    ->actingAs(User::find(1))
                    ->get(route('articles.edit', ['article' => Article::find(1)]))
                    ->assertStatus(200);
    }

    // 記事詳細画面
    public function testArticleShowView()
    {
        $response = $this->get(route('articles.show', ['article' => Article::find(1)]))
                        ->assertStatus(200);
    }
}
