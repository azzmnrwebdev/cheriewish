<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query();
        $search = $request->input('search');

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $categories = $query->with('products')->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.category.index', compact('search', 'categories'));
    }

    public function create()
    {
        return view('admin.pages.category.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:225|unique:categories,name',
            'description' => 'nullable|string|max:250',
        ];

        $messages = [
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be text.',
            'name.max' => 'Category name should not exceed 225 characters.',
            'name.unique' => 'Category name already in use.',
            'description.string' => 'Short descriptions must be text.',
            'description.max' => 'Short description should not exceed 250 characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            return DB::transaction(function () use ($request) {
                $slug = Str::slug($request->input('name'));

                $category = Category::create([
                    'name' => $request->input('name'),
                    'slug' => $slug,
                    'description' => $request->input('description'),
                ]);

                return redirect(route('category.show', ['category' => $category->slug]))->with('success', 'Category successfully saved.');
            });
        } catch (Exception $e) {
            return redirect(route('category.index'))->with('error', 'An error occurred while saving data.');
        }
    }

    public function show(Category $category)
    {
        $categories = Category::orderByDesc('updated_at')->latest('created_at')->get();

        $currentIndex = $categories->search(function ($item) use ($category) {
            return $item->id === $category->id;
        });

        $previousCategory = $categories->get($currentIndex - 1);
        $nextCategory = $categories->get($currentIndex + 1);

        return view('admin.pages.category.show', compact('category', 'previousCategory', 'nextCategory'));
    }

    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $rules = [
            'name' => 'required|string|max:225|unique:categories,name,' . $category->id,
            'description' => 'nullable|string|max:250',
        ];

        $messages = [
            'name.required' => 'Category name is required.',
            'name.string' => 'Category name must be text.',
            'name.max' => 'Category name should not exceed 225 characters.',
            'name.unique' => 'Category name already in use.',
            'description.string' => 'Short descriptions must be text.',
            'description.max' => 'Short description should not exceed 250 characters.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            return DB::transaction(function () use ($request, $category) {
                $newName = $request->input('name');

                $slug = $category->slug;
                if ($newName !== $category->name) {
                    $slug = Str::slug($newName);
                }

                $category->update([
                    'name' => $newName,
                    'slug' => $slug,
                    'description' => $request->input('description'),
                ]);

                return redirect(route('category.show', ['category' => $category->slug]))->with('success', 'Category successfully updated.');
            });
        } catch (Exception $e) {
            return redirect(route('category.index'))->with('error', 'An error occurred while updating data.');
        }
    }

    public function destroy(Category $category, Request $request)
    {
        if ($request->input('name_confirmation') !== $category->name) {
            return redirect()->back()->with('error', 'Confirmed name does not match category name.');
        }

        try {
            return DB::transaction(function () use ($category) {
                $category->products;

                $category->products()->detach();

                foreach ($category->products as $product) {
                    $product->categories()->detach();

                    Storage::disk('public')->delete($product->thumbnail->path);
                    $product->thumbnail->delete();

                    foreach ($product->images as $image) {
                        Storage::disk('public')->delete($image->path);
                        $image->delete();
                    }

                    $product->delete();
                }

                $category->delete();

                return redirect(route('category.index'))->with('success', 'Category successfully deleted.');
            });
        } catch (Exception $e) {
            return redirect(route('category.index'))->with('error', 'An error occurred while deleting data.');
        }
    }
}
