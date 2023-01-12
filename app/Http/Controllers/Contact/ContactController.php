<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $this->authorize('read-contacts');

        $request = request();

        $query = Contact::query();

        if ($search = $request->query('search')) {
            $query->where('name', 'like', "%{$search}%");
        }
        $data = $query->select('id', 'name', 'email', 'title', 'comment', 'phone', 'created_at')->orderByDesc('id')->paginate(page_numbering_back);

        // return response()->json($data);
        return response()->view('backend.contact.index', ['contacts' => $data]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required|string|max:100',
            'email'             => 'required|email',
            'title'             => 'required|string',
            'comment'           => 'required|string'
        ]);
        if (!$validator->fails()) {
            $isSave = Contact::create($request->only(['name', 'email', 'title', 'phone', 'comment']));
            if ($isSave) {
                return response()->json(['message' => $isSave ? 'تم إرسال الرسالة بنجاح' : 'هناك خطأ ما'], $isSave ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
            }
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }


    public function destroy(Contact $contact)
    {
        $this->authorize('delete-contact', $contact);

        $isDelete = $contact->delete();
        return response()->json([
            'icon'  =>  $isDelete ? 'success' : 'error',
            'title' =>  $isDelete ? 'تم الحذف بنجاح' : 'فشل الحذف',
        ], $isDelete ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }
}
