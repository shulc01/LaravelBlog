<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin()
    {

        $allArticles = Article::leftJoin('categories', 'articles.category_id', '=' , 'categories.id_cat')
                                ->select('articles.id', 'articles.title', 'categories.category_name', 'categories.id_cat', 'articles.description')
                                ->orderBy('updated_at', 'desc')
                                ->get();

        return view('adminShow')->with('allArticles', $allArticles);

    }

    public function editArticle($id)
    {

        $editArticle = Article::find($id);

        $allCategories = Category::all();

        $allTags = Tag::all();

        if (isset($editArticle->tags_id)) {

            $tagsIdArticle = explode(';', $editArticle->tags_id);

            $tags_name = Tag::whereIn('id_tag', $tagsIdArticle)->get();

            $tagsArticle = '';

            foreach ($tags_name as $value) {

                $tagsArticle .= $value->tag_name . '; ';

            }

            $data = [                                    //???
                'editArticle' => $editArticle,
                'allСategories' => $allCategories,
                'allTags' => $allTags,
                'tagsArticle' => $tagsArticle,
                'tagsIdArticle' => $tagsIdArticle
            ];

        } else

            $data = [
                'editArticle' => $editArticle,
                'allСategories' => $allCategories,
                'allTags' => $allTags
            ];

            return view('editArticle')->with($data);
    }

    public function saveArticle(Request $request)
    {

        $this->validate($request,
             [ 'title' => 'required|min:3',
                'description' => 'required|min:3',
                'image' => 'required|min:3',
                'text' => 'required|min:3',
             ]);

        unset($request['_token']);

        $data = $request->all();

        if($data['custom_tags']) {

            $tags_custom_id = '';

            $data['custom_tags'] = mb_strtolower($data['custom_tags']);

            $data['custom_tags'] = explode(';', $data['custom_tags']);

            $data['custom_tags'] = array_diff(array_map('trim', $data['custom_tags']), ['', 0, null]);

            $custom_tags = $data['custom_tags'];

            $issetTags = Tag::where(function($query) use ($custom_tags) {

                foreach($custom_tags as $custom_tag){

                    $query->orWhere('tag_name', 'LIKE', $custom_tag);

                }

            })->get();

            if(count($issetTags) > 0) {  //isset tag in DB

                foreach($issetTags as $value) {

                    $tags_custom_id .= $value->id_tag . ';';

                    foreach ($custom_tags as $key => $unset_tag) {

                        if ($value->tag_name == $unset_tag) unset($custom_tags[$key]);

                    }
                }
            }

            if ($custom_tags) {  // if isset new tags

                $newCustomTags = [];

                foreach ($custom_tags as $value) {

                    $newCustomTags[] =['tag_name' => $value];
                }

                Tag::insert($newCustomTags);

                $ids_new_tags = Tag::select('id_tag')->whereIn('tag_name', $newCustomTags)->get();

                $tags_custom_id = '';

                foreach ($ids_new_tags as $id_new_tag) {

                    $tags_custom_id .= $id_new_tag->id_tag . ';';

                }
            }
        }

        if ($data['id']) { //edit article

            if(isset($data['tags_id'])) $data['tags_id'] = implode(';' , $data['tags_id']) . ';';

            if(isset($tags_custom_id)) $data['tags_id'] = $data['tags_id'] . $tags_custom_id;

            unset($data['custom_tags']);

            Article::where('id', $data['id'])->update($data);

        } else {            //add article

                if (isset($data['tags_id'])) {

                    $tags_id = '';

                    foreach ($data['tags_id'] as $tagsid) {

                        $tags_id .= $tagsid . ';';

                    }

                    if (isset($tags_custom_id)) $tags_id .= $tags_custom_id;

                    $data['tags_id'] = $tags_id;

                }

            $article = new Article;
            $article->fill($data);
            $article->save();

        }

        return redirect('/admin');

    }

    public function createArticle()
    {

        $allСategories = Category::all();

        $allTags = Tag::all();

        $data = [
            'allСategories' => $allСategories,
            'allTags' => $allTags
        ];

        return view('editArticle')->with($data);
    }

    public function deleteArticle($id)
    {

        Article::find($id)->delete();

        return redirect('/admin');

    }

    public function createCategory()
    {

        return view('add-cat');

    }

    public function saveCategory(Request $request)
    {

        $this->validate($request,
            ['category_name' => 'required|min:3',
             'category_desc' => 'required|min:3'
            ]);

        $data = $request->all(); ////hot fix!

        $category = new category; 
        $category->fill($data);
        $category->save();

        return redirect('/admin');

    }

} //end class AdmiController