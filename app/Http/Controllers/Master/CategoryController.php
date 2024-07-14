<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = 10;
        $query = Category::orderByDesc('created_at');
    
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }
    
        $categoryCoas = $query->paginate($perPage);
        
        return view('pages.master.category.index', compact('categoryCoas'));
    }
    
    public function create()
    {
        return view("pages.master.category.create");
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'status'    => 'required',
        ]);

        $categoryCoa            = new Category();
        $categoryCoa->name      = $request->name;
        $categoryCoa->status    = $request->status;
        $categoryCoa->save();

        $message = [
            "status" => "success",
            "message" => "Data created successfully"
        ];

        if ($request->has('save_and_add_other')) {
            return redirect()->route('master.category.create')->with("message", $message);
        } else {
            return redirect()->route('master.category.index')->with("message", $message);
        }
    }
    
    public function edit($id)
    {
        $categoryCoa = Category::where('id', $id)->first();
        return view("pages.master.category.edit", compact('categoryCoa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'status'    => 'required',
        ]);

        $categoryCoa            = Category::where('id', $id)->first();
        $categoryCoa->name      = $request->name;
        $categoryCoa->status    = $request->status;
        $categoryCoa->update();

        $message = [
            "status" => "success",
            "message" => "Data updated successfully"
        ];

        if ($request->has('update_and_continue_editing')) {
            return redirect()->back()->with("message", $message);
        } else {
            return redirect()->route('master.category.index')->with("message", $message);
        }
    }
    
    public function show($id)
    {
        $categoryCoa = Category::where('id', $id)->first();

        return view("pages.master.category.show", compact('categoryCoa'));
    }

    public function destroy($id)
    {
        $categoryCoa = Category::where('id', $id)->delete();

        $message = [
            "status" => "success",
            "message" => "Data deleted successfully"
        ];
        
        return redirect()->route('master.category.index')->with("message", $message);
    }
}
