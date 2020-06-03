<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    // top画面表示
    public function testIndex()
    {
        $response = $this->get(route('articles.index'));

        $response->assertStatus(200)
                ->assertViewIs('articles.index');
    }

    // ユーザー登録画面の表示確認
    public function testRegisterView()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200)
                ->assertViewIs('auth.register');
    }

    // 未ログインユーザーが記事投稿画面に来た時のログイン画面へのリダイレクト
    public function testGuestCreate()
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
    }

    // ログイン済みユーザーが記事投稿画面に来れるか
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                    ->get(route('articles.create'));

        $response->assertStatus(200)
                ->assertViewIs('articles.create');
    }

    // 記事更新画面
    // public function testArticleEditView()
    // {
    //     $article = factory(Article::class)->create();
    //     $user = factory(User::class)->create();
    //     $article->user()->associate($user);
    //     $article->save();
        
    //     $response = $this
    //                 ->actingAs($user)
    //                 ->get(route('articles.edit', ['article' => $article]))
    //                 ->assertStatus(200);
    // }

    // // 記事詳細画面
    // public function testArticleShowView()
    // {
    //     $response = $this->get(route('articles.show', ['article' => Article::find(1)]))
    //                     ->assertStatus(200);
    // }
}
