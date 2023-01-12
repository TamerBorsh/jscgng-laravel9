<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FrontController extends Controller
{


    public function index()
    {
        // $categories = Category::with(['last_posts'])->get()->each(function ($query) {
        //     $query->setRelation('last_posts', $query->last_posts->take(2));
        //     return $query;
        // });

        $post = Post::select(
            'id',
            'slug',
            'category_id',
            'user_id',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'description_' . LaravelLocalization::getCurrentLocale() . ' as description',
            'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords',
            'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
            'is_active',
            'created_at'
        )->whereIs_active('1')->orderByDesc('id');

        $slider = $post->limit('8')->get();

        $activity = $post->where('category_id', '1')->limit('6')->get();

        $project = Post::select(
            'id',
            'slug',
            'category_id',
            'user_id',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'description_' . LaravelLocalization::getCurrentLocale() . ' as description',
            'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords',
            'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
            'is_active',
            'created_at'
        )->whereIs_active('1')->where('category_id', '2')->limit('8')->orderByDesc('id')->get();

        $gallery = Post::select(
            'id',
            'slug',
            'category_id',
            'user_id',
            'photo',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'description_' . LaravelLocalization::getCurrentLocale() . ' as description',
            'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords',
            'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
            'is_active',
            'created_at'
        )->whereIs_active('1')->where('category_id', '3')->limit('8')->orderByDesc('id')->get();

        // return response()->json($slider);

        return response()->view('front.index', ['sliders' => $slider, 'activities' => $activity, 'projects' => $project, 'galleries' => $gallery]);
    }



    public function show($slug)
    {


        $post = Post::whereHas('category', function ($quary) {
            $quary->whereIs_active('1');
        })->select(
            'id',
            'slug',
            'category_id',
            'user_id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'description_' . LaravelLocalization::getCurrentLocale() . ' as description',
            'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords',
            'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
            'photo',
            'is_active',
            'view_count',
            'created_at'
        )->whereIs_active('1')->whereSlug($slug)->first();

        // return response()->json($post);

        return response()->view('front.single', ['post' => $post]);
    }
    
    public function showPage($slug){
        $page = Page::select(
            'id',
            'slug',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'description_' . LaravelLocalization::getCurrentLocale() . ' as description',
            'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords',
            'content_' . LaravelLocalization::getCurrentLocale() . ' as content',
            'is_active',
            'view_count',
            'created_at'
        )->whereIs_active('1')->whereSlug($slug)->first();


        // return response()->json($page);


        return response()->view('front.single', ['post' => $page]);
    }
}
