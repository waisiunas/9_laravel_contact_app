<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereId(Auth::id())->with('contacts')->first();
        // dd($user->contacts);
        return view('contact.index', [
            'contacts' => $user->contacts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create', [
            'categories' => Category::whereUser_id(Auth::id())->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'category_id' => ['required', 'numeric'],
            'mobile' => ['required', 'string'],
            'picture' => ['image', 'mimes:png,jpg,jpeg,webp', 'nullable'],
            'facebook' => ['url', 'nullable'],
            'instagram' => ['url', 'nullable'],
            'youtube' => ['url', 'nullable'],
        ]);

        $file_name = null;

        if ($request->picture) {
            $file_name = $request->picture->hashName();
            $target_directory = 'template/img/contacts/';
            $request->picture->move(public_path($target_directory), $file_name);
        }

        $data = $request->except('picture', '_token');
        $data['picture'] = $file_name;

        if (Contact::create($data)) {
            return redirect()->back()->with(['success' => 'Magic has been spelled!']);
        } else {
            return redirect()->back()->with(['failure' => 'Magic has failed to spell!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
