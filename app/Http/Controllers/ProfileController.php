<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user =  User::find(Auth::id());
    }


    public function show()
    {
        return view('profile.show', [
            'user' => $this->user,
        ]);
    }

    public function details(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->user->id . ',id'],
        ]);

        if ($this->user->update($request->all())) {
            return redirect()->back()->with([
                'success' => 'Magic has been spelled!'
            ]);
        } else {
            return redirect()->back()->with([
                'failure' => 'Magic has failed to spell!'
            ]);
        }
    }

    public function password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
            'current_password' => ['required'],
        ]);

        if (Hash::check($request->current_password, $this->user->password)) {
            if ($this->user->update($request->all())) {
                return redirect()->back()->with([
                    'success' => 'Magic has been spelled!'
                ]);
            } else {
                return redirect()->back()->with([
                    'failure' => 'Magic has failed to spell!'
                ]);
            }
        } else {
            return redirect()->back()->withErrors(['current_password' => 'Current password does not match!']);
        }
    }

    public function picture(Request $request)
    {
        $request->validate([
            'picture' => ['required', 'image', 'mimes:png,jpg,jpeg,webp'],
        ]);

        $target_directory = 'template/img/photos/';

        if ($this->user->picture && File::exists($target_directory . $this->user->picture)) {
            unlink($target_directory . $this->user->picture);
        }

        $file_name = $request->picture->hashName();

        if ($request->picture->move(public_path($target_directory), $file_name)) {
            $data = [
                'picture' => $file_name,
            ];

            if ($this->user->update($data)) {
                return redirect()->back()->with(['success' => 'Magic has been spelled!']);
            } else {
                return redirect()->back()->with(['failure' => 'Magic has failed to spell!']);
            }
        } else {
            return redirect()->back()->with(['failure' => 'Unable to upload picture!']);
        }
    }
}
