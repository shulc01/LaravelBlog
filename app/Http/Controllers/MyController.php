<?php

namespace App\Http\Controllers;

use App\Article;
use App\category;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyController extends Controller
{
    public function articles() {

    $header = 'Header';
    $footer = 'Footer';

    $articles = Article::all()->sortByDesc('created_at');

   return view('page')->with(['header' => $header,
                                    'footer' => $footer,
                                    'articles' => $articles
                                    ]);
    }

    public function article($id) {

        $article = Article::find($id);

        $category_name = category::where('id_cat', $article->category_id)->first();

        $tagsid = explode(';' , $article->tags_id);

        $tagsidnotnull = array_diff($tagsid, array('', 0, null));

        $tags = Tag::whereIn('id_tag' , $tagsidnotnull)->get();

        $article->category_name = $category_name->category_name;

        $article->tags = $tags;

        return view('single-article')->with('article', $article);

    }

    public function ShowCat() {

        $categories = Category::all();

        return view('show-cat')->with('categories', $categories);

    }

    public function SingleCat($id) {

        $articles = Article::
                    leftJoin('categories', 'articles.category_id', '=' , 'categories.id_cat')
                    ->select('articles.id', 'articles.title', 'articles.updated_at', 'categories.category_name', 'categories.id_cat', 'articles.description')
                    ->where('articles.category_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('page')->with('articles', $articles);

    }

    public function showTagArt($id) {

        $likeSearch1 = $id . ';%';

        $likeSearch2 = '%;' . $id . ';%';

        $showTagArt = Article::
                        where('tags_id', 'like', $likeSearch2)
                        ->orWhere('tags_id', 'like', $likeSearch1)
                        ->get();

        $tag_name = Tag::where('id_tag', $id)->first();

        return view('page')->with(['articles' => $showTagArt, 'tag_name' => $tag_name ]);

    }

} //end MyController