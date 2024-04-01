<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $cat = Category::latest()->get();
        $categories = SubCategory::with('category')->latest()->get();
        return view('admin.sub-category.index', compact(['categories', 'cat']));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['exists:categories,id'],
            'name' => ['required', 'string', 'max:256'],
            'slug' => ['nullable', 'string', 'max:256'],
        ]);
        $validated['slug'] = Str::slug($request->name);
        SubCategory::create($validated);
        return redirect()->route('Sub-category.index')->with('success', 'Sub-category Created Successful');
    }

    public function status($id)
    {
        $id = Crypt::decrypt($id);
        $lead = SubCategory::find($id);

        if ($lead->status == 'active') {
            $lead->status = Status::Deactive;
        } elseif ($lead->status == 'deactive') {
            $lead->status = Status::Active;
        }
        $lead->save();

        return redirect()->route('Sub-category.index')->with('success', 'Sub Category status updated successfully.');
    }

    public function edit($id)
    {
        $cat = Category::latest()->get();
        $id = Crypt::decrypt($id);
        $category = SubCategory::find($id);
        return view('admin.sub-category.edit', compact(['category', 'cat']));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:256'],
            'slug' => ['nullable', 'string', 'max:256'],
            'status' => ['required'],
        ]);

        $validated['slug'] = Str::slug($request->name);

        SubCategory::find($request->id)->update($validated);

        return redirect()->route('Sub-category.index')->with('success', 'sub-category Updated Successful');
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);

        SubCategory::find($id)->delete();

        return redirect()->route('Sub-category.index')->with('success', 'Sub-category Deleted Successful');
    }
}
