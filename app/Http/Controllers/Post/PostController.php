<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Traits\ImageTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:web');
        $this->authorizeResource(Post::class, 'post');
    }

    public function index()
    {
        $request = request();

        $query = Post::query();

        if ($search = $request->query('search')) {
            $query->where('name_ar', 'like', "%{$search}%")->orWhere('name_en', 'like', "%{$search}%");
        }
        $data = $query->select('id', 'category_id', 'user_id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description',  'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords', 'content_' . LaravelLocalization::getCurrentLocale() . ' as content', 'photo', 'is_active', 'created_at')->orderByDesc('id')->paginate(page_numbering_back);

        // return response()->json($data);
        return response()->view('backend.post.index', ['posts' => $data]);
    }

    public function create()
    {
        $category = Category::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name')->get();
        return response()->view('backend.post.create', ['categories' => $category]);
    }

    public function store(Request $request)
    {

        if ($request->hasFile('photo_post') && request('photo_post') != null) {

            $file = $request->file('photo_post');
            $fileName = date('YmdHi') . time() . rand(1, 50) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/uploads/posts/'), $fileName);

            $request->merge([
                'photo'         => url('/') . '/images/uploads/posts/' . $fileName
            ]);
        }

        $request->merge([
            'slug'          => Str::slug($request->name_en),
            'user_id'       => auth()->user()->id,
            'photo'         => $request->photo
        ]);

        $data = $request->only(["name_ar", "name_en", "slug", "user_id", "category_id", "photo", "keywords_ar", "keywords_en", "description_ar", "description_en", "content_en", "content_ar", "is_active"]);

        $post = Post::create($data);
        if ($post) {
            return response()->json(['message' => $post ? 'تم الحفظ' : 'هناك خطأ ما'], $post ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $category = Category::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name')->get();
        return response()->view('backend.post.edit', ['post' => $post, 'categories' => $category]);
    }

    public function update(Request $request, Post $post)
    {

        if ($request->hasFile('photo_post') && request('photo_post') != null) {

            $file = $request->file('photo_post');
            $fileName = date('YmdHi') . time() . rand(1, 50) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/uploads/posts/'), $fileName);

            $request->merge([
                'photo'         => url('/') . '/images/uploads/posts/' . $fileName
            ]);
        }

        $request->merge([
            'slug'          => Str::slug($request->name_en),
        ]);

        $data = $request->only(["name_ar", "name_en", "slug", "category_id", "photo", "keywords_ar", "keywords_en", "description_ar", "description_en", "content_en", "content_ar", "is_active"]);

        $isSave = $post->update($data);
        if ($isSave) {
            return response()->json(['message' => $isSave ? 'تم الحفظ' : 'هناك خطأ ما'], $isSave ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    public function updateActive(Request $request)
    {
        // return response()->json($request->all());

        $post = Post::find($request->post_id);
        $post->is_active =          $request->active;

        $post->save();
    }


    public function destroy(Post $post)
    {
        $isDelete = $post->delete();
        $file_path  = public_path('images/uploads/posts/') . $post->photo;
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        return response()->json([
            'icon'  =>  $isDelete ? 'success' : 'error',
            'title' =>  $isDelete ? 'تم الحذف بنجاح' : 'فشل الحذف',
        ], $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
