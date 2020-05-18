<?php

namespace App\Http\Controllers;

use App\Article;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // 記事トップページ
    public function index()
    {
        // 記事データ
        $articles = Article::all()->sortByDesc('created_at');

        // トップページ(記事一覧)を表示
        return view('articles.index', ['articles' => $articles]);
    }
}
