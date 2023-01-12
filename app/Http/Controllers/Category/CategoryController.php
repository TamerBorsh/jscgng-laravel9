<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web');
        $this->authorizeResource(Category::class, 'category');
    }

    public function index()
    {
        $request = request();

        $query = Category::query();

        if ($search = $request->query('search')) {
            $query->where('name_ar', 'like', "%{$search}%")->orWhere('name_en', 'like', "%{$search}%");
        }
        $data = $query->select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description',  'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords', 'is_active', 'created_at')->orderByDesc('id')->paginate(page_numbering_back);
        // return response()->json($data);
        return response()->view('backend.category.index', ['categories' => $data]);
    }

    public function create()
    {
        return response()->view('backend.category.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug'          => Str::slug($request->name_en),
        ]);

        $data = $request->only(["name_ar", "name_en", "slug", "keywords_ar", "keywords_en", "description_ar", "description_en", "is_active"]);
        $category = Category::create($data);
        if ($category) {
            return response()->json(['message' => $category ? 'تم الحفظ' : 'هناك خطأ ما'], $category ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        return response()->view('backend.category.edit',['category' => $category]);
    }

    public function update(Request $request, Category $category)
    {
        $request->merge([
            'slug'          => Str::slug($request->name_en),
        ]);

        $data = $request->only(["name_ar", "name_en", "slug", "keywords_ar", "keywords_en", "description_ar", "description_en", "is_active"]);
        $isSave = $category->update($data);
        if ($isSave) {
            return response()->json(['message' => $isSave ? 'تم الحفظ' : 'هناك خطأ ما'], $isSave ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(Category $category)
    {
        $isDelete = $category->delete();
        return response()->json([
            'icon'  =>  $isDelete ? 'success' : 'error',
            'title' =>  $isDelete ? 'تم الحذف بنجاح' : 'فشل الحذف',
        ], $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
