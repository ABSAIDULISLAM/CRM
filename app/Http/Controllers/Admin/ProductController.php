<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Specification;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->latest()->get();
        return view('admin.product.index', compact(['products']));
    }

    public function create()
    {
        $cat = Category::where('status', 'active')->latest()->get();
        $subcat = SubCategory::where('status', 'active')->latest()->get();
        return view('admin.product.create', compact(['cat', 'subcat']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:256'],
            'category_id' => ['required','exists:categories,id'],
            'sub_category_id' => ['required','exists:sub_categories,id'],
            'price' => ['required', 'numeric', 'regex:/^\d{0,8}(\.\d{1,2})?$/'],
            'icon.*' => ['nullable','string', 'max:256'],
            'title.*' => ['nullable','string', 'max:256'],
            'description.*' => ['nullable','string', 'max:256'],
            'short_description' => ['nullable','string', 'max:1024'],
            'long_description' => ['nullable','string', 'max:2048'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
            'slug' => ['nullable', 'string', 'max:256'],
        ]);

        $slug = Str::slug($request->name);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $slug;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        if ($request->hasFile('image')) {
            $image = Upload($request->file('image'), 'uploads/products/', 400, 400);
            $product->image = $image;
        }
        $product->save();

        if ($request->filled('icon') && $request->filled('title') && $request->filled('description')) {
            foreach ($request->icon as $key => $icon) {
                $specification = new Specification();
                $specification->icon = $icon;
                $specification->title = $request->title[$key];
                $specification->description = $request->description[$key];
                $specification->product_id = $product->id;
                $specification->save();
            }
        }

        return redirect()->route('Product.index')->with('success', 'Product Created Successful');
    }

    public function status($id)
    {
        $id = Crypt::decrypt($id);
        $lead = Product::find($id);

        if ($lead->status == 'active') {
            $lead->status = Status::Deactive;
        } elseif ($lead->status == 'deactive') {
            $lead->status = Status::Active;
        }
        $lead->save();

        return redirect()->route('Product.index')->with('success', 'Product status updated successfully.');
    }


    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $cat = Category::latest()->get();
        $subcat = SubCategory::latest()->get();
        $specifications = Specification::where('product_id', $id)->get();

        $product = Product::find($id);
        return view('admin.product.edit', compact(['product', 'cat', 'subcat', 'specifications']));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:256'],
            'category_id' => ['required','exists:categories,id'],
            'sub_category_id' => ['required','exists:sub_categories,id'],
            'price' => ['required', 'numeric', 'regex:/^\d{0,8}(\.\d{1,2})?$/'],
            'icon.*' => ['nullable','string', 'max:256'],
            'title.*' => ['nullable','string', 'max:256'],
            'description.*' => ['nullable','string', 'max:256'],
            'short_description' => ['nullable','string', 'max:1024'],
            'long_description' => ['nullable','string', 'max:2048'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp'],
            'slug' => ['nullable', 'string', 'max:256'],
        ]);

        $slug = Str::slug($request->name);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->slug = $slug;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->price = $request->price;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->status = $request->status;
        if ($request->hasFile('image')) {
            if ($product->image && file_exists($product->image)) {
                unlink($product->image);
            }
            $image = Upload($request->file('image'), 'uploads/products/', 400, 400);
            $product->image = $image;
        }
        $product->save();

        if ($request->filled('icon') && $request->filled('title') && $request->filled('description')) {
            foreach ($request->icon as $key => $icon) {
                $specificationId = $request->specification_id[$key] ?? null;
                if ($specificationId) {
                    $specification = Specification::find($specificationId);
                    $specification->icon = $icon;
                    $specification->title = $request->title[$key];
                    $specification->description = $request->description[$key];
                    $specification->save();
                }
            }
        }

        return redirect()->route('Product.index')->with('success', 'Product Updated Successful');
    }


    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $data = Product::find($id);
        if ($data->image && file_exists($data->image)) {
            unlink($data->image);
        }
        $data->delete();

        return redirect()->route('Product.index')->with('success', 'Product Deleted Successful');
    }

    public function view($id)
    {
        $id = Crypt::decrypt($id);
        $product =  Product::with(['specification', 'category', 'subcategory'])->find($id);
        return view('admin.product.view',compact('product'));
    }


    public function Search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where(function ($q) use ($query) {
                $q->whereHas('category', function ($category) use ($query) {
                    $category->where('name', 'like', "%$query%");
                })
                ->orWhereHas('subcategory', function ($subcategory) use ($query) {
                    $subcategory->where('name', 'like', "%$query%");
                });
            })
            ->orWhere('name', 'like', "%$query%")
            ->orWhere('slug', 'like', "%$query%")
            ->orWhere('price', 'like', "%$query%")
            ->orWhere('status', 'like', "%$query%")
            ->orWhere('created_at', 'like', "%$query%")
            ->with(['category', 'subcategory'])
            ->paginate(10);

        $html = view('admin.Product.search', compact('products'))->render();

        return response()->json(['html' => $html]);
    }


}
