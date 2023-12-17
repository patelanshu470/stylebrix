<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function catIndex()
    {
        $datas = Category::all();
        return view('backend.category.cat_index', compact('datas'));
    }
    public function catAdd()
    {
        return view('backend.category.cat_add');
    }
    public function catStore(Request $request)
    {
        $dublicate_check = Category::where('name', 'like', $request->name)->get()->first();
        if ($dublicate_check) {
            return back()->with('error', "Dublicate entry is not allowed.");
        }
        $data = new Category();
        $data->name = $request->name;
        if ($request->file('image')) {
            $uploadFile = $request->file('image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/category/', $file_name);
            $data['image'] = $file_name;
        }
        $data->status = $request->status;
        $data->save();

        return back()->with('success', "Category created successfully");
    }
    public function catEdit($id)
    {
        $data = Category::find($id);
        return view('backend.category.cat_edit', compact('data'));
    }

    public function catUpdate(Request $request, $id)
    {
        $dublicate_check = Category::where([['name', 'like', $request->name], ['id', '<>', $id]])->get()->first();
        if ($dublicate_check) {
            return back()->with('error', "Dublicate entry is not allowed.");
        }
        $data = Category::find($id);
        $data->name = $request->name;
        if ($request->file('image')) {
            if ($data->image) {
                unlink('public/images/category/' . $data->image);
            }
            $uploadFile = $request->file('image');
            $file_name = $uploadFile->hashName();
            $path = $uploadFile->move('public/images/category/', $file_name);
            $data['image'] = $file_name;
        }
        $data->status = $request->status;
        $data->save();
        return redirect()->route('category')->with('success', "Category updated successfully");
    }

    public function catDelete($id)
    {
        $category = Category::findOrFail($id);
        if ($category->image) {
            $imagePath = 'public/images/category/' . $category->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $category->delete();
        return back()->with('success', "Category is delete successfully.");
    }
    public function catStatus(Request $request)
    {
        $data = Category::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json([
            'success' => 'Category status has been updated successfully!'
        ]);
    }
}
