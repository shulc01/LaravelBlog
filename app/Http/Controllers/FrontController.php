<?php

namespace App\Http\Controllers;

use App\Article;
use App\category;
use App\Tag;
use Illuminate\Support\Facades\View;
use PhpParser\Node\Expr\Array_;


class FrontController extends Controller
{

    public function __construct()
    {

        $allCat = Category::all();

        View::share('categories', $allCat);

    }

    public function articles()
    {

        $articles = Article::all()->sortByDesc('created_at');

        return view('page')->with('articles', $articles);

    }

    public function article($id)
    {

        $article = Article::find($id);

        $category_name = category::where('id_cat', $article->category_id)->first();

        $tagsid = explode(';' , $article->tags_id);

        $tagsidnotnull = array_diff($tagsid, array('', 0, null));

        $tags = Tag::whereIn('id_tag' , $tagsidnotnull)->get();

        $article->category_name = $category_name->category_name;

        $article->tags = $tags;

        return view('single-article')->with('article', $article);

    }

    public function ShowCat()
    {

        return view('show-cat');

    }

    public function SingleCat($id)
    {

        $articles = Article::
                    leftJoin('categories', 'articles.category_id', '=' , 'categories.id_cat')
                    ->select('articles.id', 'articles.title', 'articles.updated_at', 'categories.category_name', 'categories.id_cat', 'articles.description')
                    ->where('articles.category_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

        if (collect($articles)->isNotEmpty()) {

            return view('page')->with('articles', $articles);

        } else {

            $noArticles = 'Sorry, there are no articles in this category';

            return view('page')->with('noArt', $noArticles);

        }
    }

    public function DelCat($id)
    {

        category::where('id_cat', $id)->delete();

        $articles = Article::where('category_id', $id)->delete();

        return redirect('/articles');

    }

    public function showTagArt($id)
    {

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