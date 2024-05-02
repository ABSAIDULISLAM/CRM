<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MarketingStuffController extends Controller
{
    public function index()
    {
        $marketing = User::where('role_as', 'active')->latest()->get();
        return view('admin.account.marketing.index', compact('marketing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:256'],
            'slug' => ['nullable', 'string', 'max:256'],
            'image' => ['nullable', 'mimes:png,jpg,webp,jpeg', 'max:2048'],
        ]);

        $slug = Str::slug($request->name);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;

        if ($request->hasFile('image')) {
            $image = Upload($request->file('image'), 'uploads/categories/', 400, 400);
            $category->image = $image;
        }
        $category->save();

        return redirect()->route('Category.index')->with('success', 'Category Created Successful');
    }

    public function status($id)
    {
        $id = Crypt::decrypt($id);
        $lead = Category::find($id);

        if ($lead->status == 'active') {
            $lead->status = Status::Deactive;
        } elseif ($lead->status == 'deactive') {
            $lead->status = Status::Active;
        }
        $lead->save();

        return redirect()->route('Category.index')->with('success', 'Category status updated successfully.');
    }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:256'],
            'slug' => ['nullable', 'string', 'max:256'],
            'image' => ['nullable', 'mimes:png,jpg,webp,jpeg', 'max:2048'],
            'status' => ['required'],
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;

        if ($request->hasFile('image')) {
            if ($category->image && file_exists($category->image)) {
                unlink($category->image);
            }
            $image = Upload($request->file('image'), 'uploads/categories/', 400, 400);
            $category->image = $image;
        }

        $category->save();

        return redirect()->route('Category.index')->with('success', 'Category Updated Successful');
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $data = Category::find($id);
        if ($data->image && file_exists($data->image)) {
            unlink($data->image);
        }
        $data->delete();

        return redirect()->route('Category.index')->with('success', 'Category Deleted Successful');
    }
}
