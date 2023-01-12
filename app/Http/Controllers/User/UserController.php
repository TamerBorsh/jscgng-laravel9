<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth:web');
        $this->authorizeResource(User::class, 'user');
    }

    public function index()
    {
        $request = request();

        $query = User::query();

        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }
        $data = $query->orderByDesc('id')->paginate(page_numbering_back);

        return response()->view('backend.user.index', ['users' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereGuard_name('web')->get();
        return response()->view('backend.user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = Role::findById($request->input('role_id'), 'web');

        if ($request->hasFile('photo_user') && request('photo_user') != null) {
            $request->photo                     = $this->SaveImage($request->file('photo_user'), 'images/uploads/users/');
        }

        $request->merge(['photo'    => $request->photo]);

        $data = $request->only(["name", "email", "password", "photo"]);

        $user = User::create($data);
        if ($user) {
            $user->assignRole($role);
            return response()->json(['message' => $user ? 'تم الحفظ' : 'هناك خطأ ما'], $user ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {

        $roles = Role::whereGuard_name('web')->get();
        $roleAdmin =  $user->roles()->first();

        if (!$user) {
            return abort('404');
        } else {
            return response()->view('backend.user.edit', ['user' => $user, 'roles' => $roles, 'roleAdmin' => $roleAdmin]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        $role = Role::findById($request->input('role_id'), 'web');

        if ($request->hasFile('photo_user') && request('photo_user') != null) {
            $request->photo                     = $this->SaveImage($request->file('photo_user'), 'images/uploads/users/');

            $file_path  = public_path('images/uploads/users/') . $user->photo;
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        $request->merge(['photo'    => $request->photo]);

        $data = $request->only(["name", "email", "password", "photo"]);

        $isSave = $user->update($data);
        if ($isSave) {
            $user->syncRoles($role);
            return response()->json(['message' => $user ? 'تم الحفظ' : 'هناك خطأ ما'], $user ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        $isDelete = $user->delete();
        $file_path  = public_path('images/uploads/users/') . $user->photo;
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        return response()->json([
            'icon'  =>  $isDelete ? 'success' : 'error',
            'title' =>  $isDelete ? 'تم الحذف بنجاح' : 'فشل الحذف',
        ], $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
