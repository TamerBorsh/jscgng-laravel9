<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
        $this->authorizeResource(Page::class, 'page');
    }

    public function index()
    {
        $request = request();

        $query = Page::query();

        if ($search = $request->query('search')) {
            $query->where('name_ar', 'like', "%{$search}%")->orWhere('name_en', 'like', "%{$search}%");
        }
        $data = $query->select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'description_' . LaravelLocalization::getCurrentLocale() . ' as description',  'keywords_' . LaravelLocalization::getCurrentLocale() . ' as keywords', 'content_' . LaravelLocalization::getCurrentLocale() . ' as content', 'is_active', 'created_at')->orderByDesc('id')->paginate(page_numbering_back);
        // return response()->json($data);
        return response()->view('backend.page.index', ['pages' => $data]);
    }

    public function create()
    {
        return response()->view('backend.page.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'slug'          => Str::slug($request->name_en),
        ]);

        $data = $request->only(["name_ar", "name_en", "slug", "keywords_ar", "keywords_en", "description_ar", "description_en", "content_en", "content_ar", "is_active"]);

        $page = Page::create($data);
        if ($page) {
            return response()->json(['message' => $page ? 'تم الحفظ' : 'هناك خطأ ما'], $page ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Page $page)
    {
        //
    }

    public function edit(Page $page)
    {
        return response()->view('backend.page.edit', ['page' => $page]);
    }
    public function updateActive(Request $request)
    {
        $page = Page::find($request->page_id);
        $page->is_active =          $request->active;

        $page->save();
    }
    public function update(Request $request, Page $page)
    {
        $request->merge([
            'slug'          => Str::slug($request->name_en),
        ]);

        $data = $request->only(["name_ar", "name_en", "slug", "keywords_ar", "keywords_en", "description_ar", "description_en", "content_en", "content_ar", "is_active"]);

        $isSave = $page->update($data);
        if ($isSave) {
            return response()->json(['message' => $isSave ? 'تم الحفظ' : 'هناك خطأ ما'], $isSave ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(Page $page)
    {
        $isDelete = $page->delete();
        return response()->json([
            'icon'  =>  $isDelete ? 'success' : 'error',
            'title' =>  $isDelete ? 'تم الحذف بنجاح' : 'فشل الحذف',
        ], $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
