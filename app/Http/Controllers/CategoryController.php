<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // MOVE TO CATEGORY PAGE
    public function index()
    {
        $categories = Category::all();

        return view('admin.category',compact('categories'));
    }

    // FOR INSERTING DATA
    public function insertData(Request $req)
    {
        $req->validate([
            'category' => 'required|string|max:30',
        ]);

        $data = new Category([
            'name' => $req->category,
        ]);

        if($data->save())
            return redirect()->route('view.category');
        else
            return 0;
    }

    // FOR DELETING SINGLE RECORD
    public function deleteData(string $id)
    {
        $data = Category::find($id);
        if($data->delete())
            return redirect()->route('view.category');
    }
}
