<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('pages.accounts.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($request->file('avatar')) {
            $request->validate([
                'avatar' => 'required|file|image|max:1240',
            ]);

            $image = $request->file('avatar');

            $imagename = $image->getClientOriginalName();
            $a = explode(".", $imagename);
            $fileExt = strtolower(end($a));
            $namaFile = substr(md5(date("YmdHis")), 0, 10) . "." . $fileExt;
            $destination_path = public_path() . '/media/avatars/';

            $request->file('avatar')->move($destination_path, $namaFile);

            $request->user()->avatar = $namaFile;
        }

        $request->user()->save();

        $message = [
            "status" => "success",
            "message" => "Profile updated success"
        ];

        return Redirect::route('account.profile.edit')->with('message', $message);
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function password(){
        return view('pages.accounts.profile.password');
    }

    public function changePassword(Request $request) {
        
        $credentials = $request->validate([
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('current password tidak sesuai');
                    }
                },
            ],
            'password' => 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required|min:8',
        ]);

        $request->user()->password = Hash::make($credentials["password"]);
        $request->user()->save();

        $message = [
            "status" => "success",
            "message" => "change password successfully"
        ];

        return Redirect::route('account.profile.password')->with('message', $message);
    }
}
