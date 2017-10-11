<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Support\Facades\View;

class FrontController extends Controller
{

    public function __construct()
    {

        $allCategories = Category::all();

        View::share('categories', $allCategories);

    }

    public function showAllArticles()
    {

        $articles = Article::all()->sortByDesc('created_at');

        return view('page')->with('articles', $articles);

    }
    public function showArticle($id)
    {

        $article = Article::find($id);

        $category = Category::where('id_cat', $article->category_id)->first();

        if (isset($article->tags_id)) {

            $tags_id = explode(';', $article->tags_id);

            $deleteNullTagsId = array_diff($tags_id, ['', 0, null]);

            $tags = Tag::whereIn('id_tag', $deleteNullTagsId)->get();

            $data = [
                'article' => $article,
                'tags' => $tags,
                'category' => $category
            ];

        }

        else

            $data = [
                'article' => $article,
                'category' => $category
            ];

        return view('single-article')->with($data);

    }

    public function showAllCategories()
    {

        return view('show-cat');

    }

    public function showArticlesFromCategory($id)
    {

        $articlesFromCategory = Article::
                                leftJoin('categories', 'articles.category_id', '=' , 'categories.id_cat')
                                ->select('articles.id', 'articles.title', 'articles.updated_at', 'categories.category_name', 'categories.id_cat', 'articles.description')
                                ->where('articles.category_id', $id)
                                ->orderBy('created_at', 'desc')
                                ->get();

        if (collect($articlesFromCategory)->isNotEmpty())

            return view('page')->with('articles', $articlesFromCategory);

        else

            return view('page');
    }

    public function deleteCategory($id)
    {

        Category::where('id_cat', $id)->delete();

        Article::where('category_id', $id)->delete();

        return redirect('/categories');

    }

    public function showArticleWithTags($id)
    {

        $likeSearch1 = $id . ';%';

        $likeSearch2 = '%;' . $id . ';%';

        $articlesWithTags = Article::
                            where('tags_id', 'like', $likeSearch2)
                            ->orWhere('tags_id', 'like', $likeSearch1)
                            ->get();

        $tag_name = Tag::where('id_tag', $id)->first();

        $data = [
            'articles' => $articlesWithTags,
            'tag_name' => $tag_name
        ];

        return view('page')->with($data);

    }

} //end MyController