<?php

namespace App\Http\Controllers;

use App\Article;
use App\category;
use App\Tag;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin()
    {

        $allArticles = Article::leftJoin('categories', 'articles.category_id', '=' , 'categories.id_cat')
                                ->select('articles.id', 'articles.title', 'categories.category_name', 'categories.id_cat', 'articles.description')->get();

        return view('adminShow')->with('allarticles', $allArticles);

    }

    public function editArt(Request $request)
    {

        if($request['article']) {

            $editArticle = Article::find($request['article']);

            $all_categories = category::all();

            $tags = Tag::all();

            if (isset($editArticle->tags_id)) {

                $tags_id = explode(';', $editArticle->tags_id);

                $editArticle->tags_id = $tags_id;

                $tags_name = Tag::whereIn('id_tag', $tags_id)->get();

                $editArticle->tags_name = '';

                foreach ($tags_name as $value) {

                    $editArticle->tags_name .= $value->tag_name . '; ';

                }

            }

            return view('editArticle')->with(['editArticle' => $editArticle,
                                                    'allcat' => $all_categories,
                                                    'tags' => $tags
                                                    ]);

        } else return redirect('/admin');

    }

    public function SaveArt(Request $request)
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

            $data['custom_tags'] = array_diff(array_map('trim', $data['custom_tags']), array('', 0, null));

            $custom_tags = $data['custom_tags'];

            $result1 = Tag::where(function($query) use ($custom_tags) {

                foreach($custom_tags as $tagss){

                    $query->orWhere('tag_name', 'LIKE', $tagss);

                }

            })->get();

            if(count($result1) > 0) {  //isset tag in DB

                foreach($result1 as $value) {

                    $tags_custom_id .= $value->id_tag . ';';

                    foreach ($custom_tags as $key => $unset_tag) {

                        if ($value->tag_name == $unset_tag) {

                            unset($custom_tags[$key]);

                        }

                    }

                }

            }

            if ($custom_tags) {  // if isset new tags

                $tags = array();

                    foreach ($custom_tags as $value) {

                        $tags[] = array('tag_name' => $value);
                    }

                $tag = Tag::insert($tags);

                $ids_new_tags = Tag::select('id_tag')->whereIn('tag_name', $tags)->get();

                $id_new_tag = '';

                foreach ($ids_new_tags as $id_new_tags) {

                    $tags_custom_id .= $id_new_tags->id_tag . ';';

                }

            }

        }

        if ($data['id'] > 0) { //edit article

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

                    if ($tags_custom_id) $tags_id .= $tags_custom_id;

                    $data['tags_id'] = $tags_id;

                }

            $article = new Article;
            $article->fill($data);
            $article->save();

        }

        return redirect('/admin');

    }

    public function AddArt()
    {

        $all_categories = category::all();

        $tags = Tag::all();

        return view('editArticle')->with(['allcat' => $all_categories,
                                                'tags' => $tags
                                                ]);
    }

    public function DelArt($id)
    {

        Article::find($id)->delete();

        return redirect('/admin');

    }

    public function AddCat()
    {

        return view('add-cat');

    }

    public function saveCat(Request $request)
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
