<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;
use App\Models\User;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users-view', ['only' => ['index']]);
        $this->middleware('permission:users-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->middleware('permission:users-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = 10; 
        $query = User::whereNull('deleted_at');
        
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
            });
        }
        
        $users = $query->orderByDesc('id')->paginate($perPage);
        
        return view('pages.resources.users.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::pluck('name', 'id')->toArray();
    
        return view('pages.resources.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|string|max:255|email|unique:users',
            'password'      => 'required|min:8|same:password_confirmation',
            'avatar'        => 'nullable|file|image|max:1240',
            'role_id'       => 'required|exists:roles,id', 
        ]);

        $users                      = new User();
        $users->name                = $request->name;
        $users->email               = $request->email;

        $namaFile = null;

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
        }
        $users->password            = Hash::make($request->password);
        $users->avatar              = $namaFile;
        $users->email_verified_at   = now();
        $users->status              = 1;
        $users->save();

        $role = Role::findOrFail($request->role_id);
        $users->assignRole($role);

        $message = [
            "status" => $users ? "success" : "failed",
            "message" => $users ? "Data created successfully" : "Data failed to create!"
        ];

        if ($request->has('save_and_add_other')) {
            return redirect()->route('resources.users.create')->with("message", $message);
        } else {
            return redirect()->route('resources.users.index')->with("message", $message);
        }
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->toArray();
    
        return view('pages.resources.users.edit', compact('user', 'roles'));
    }
    

    /**
     * Display the specified resource.
     */
    function show(Request $request, $id)
    {
        $user = User::findOrFail($id);

        return view('pages.resources.users.show', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data input
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'new_password' => 'nullable|min:8|same:confirm_password',
            'confirm_password' => 'nullable|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;

        $namaFile = null;

        if ($request->file('avatar')) {
            if($user->avatar != null) {
                $oldAvatar = public_path() . '/media/avatars/' . $user->avatar;

                File::delete($oldAvatar);
            }

            $request->validate([
                'avatar' => 'file|image|max:1240',
            ]);

            $image = $request->file('avatar');

            //name file
            $imagename = $image->getClientOriginalName();
            $a = explode(".", $imagename);
            $fileExt = strtolower(end($a));
            $namaFile = substr(md5(date("YmdHis")), 0, 10) . "." . $fileExt;

            //penyimpanan
            $destination_path = public_path() . '/media/avatars/';

            // simpan ke folder
            $request->file('avatar')->move($destination_path, $namaFile);

            // set avatar value
            $user->avatar = $namaFile;
        }

        // Periksa apakah user menghapus avatar
        if($request->avatar_remove != null && $request->file("avatar") == null) {
            $oldAvatar = public_path() . '/media/avatars/' . $user->avatar;

            File::delete($oldAvatar);

            $user->avatar = null;
        }

        if ($request->filled('new_password')) {
            $user->password = bcrypt($request->new_password);
        }

        $user->save();

        $role = Role::findOrFail($request->role_id);
        $user->syncRoles([$role]);

        $message = [
            "status" => $user ? "success" : "failed",
            "message" => $user ? "Data updated successfully" : "Data failed to update!"
        ];

        if ($request->has('update_and_continue_editing')) {
            return Redirect::back()->with("message", $message);
        } else {
            return Redirect::route("resources.users.index")->with("message", $message);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->deleted_at != null) {
            $user->deleted_at = null;
        } else {
            $user->deleted_at = Carbon::now();
        }
        $user->update();

        $message = [
            "status" => $user ? "success" : "failed",
            "message" => $user ? "Data deleted successfully" : "Data failed to delete!"
        ];

        return back()->with('message', $message);
    }
}
