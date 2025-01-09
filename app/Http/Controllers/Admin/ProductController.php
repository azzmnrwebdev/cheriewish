<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $search = $request->input('search');

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $products = $query->with(['thumbnail', 'categories'])
            ->orderByDesc('updated_at')
            ->latest('created_at')
            ->paginate(10);

        return view('admin.pages.product.index', compact('search', 'products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.pages.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $rules = [
            'numberImages' => 'required|integer|min:1|max:10',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:225',
            'price' => 'required',
            'url_shopee' => 'required|url',
            'description' => 'required|string',
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png',
            'categories' => 'required|array|min:1',
            'categories.*' => 'integer|exists:categories,id',
        ];

        $messages = [
            'thumbnail.required' => 'Product thumbnail is required.',
            'thumbnail.image' => 'Product thumbnail must be an image.',
            'thumbnail.mimes' => 'Product thumbnail must be a file of type: jpg, jpeg, png.',
            'name.required' => 'Product name is required.',
            'name.string' => 'Product name must be text.',
            'name.max' => 'Product name should not exceed 225 characters.',
            'price.required' => 'Product price is required.',
            'url_shopee.required' => 'Shopee URL is required.',
            'url_shopee.url' => 'Shopee URL must be a valid URL.',
            'description.required' => 'Product description is required.',
            'description.string' => 'Product description must be text.',
            'images.required' => 'At least one image is required.',
            'images.array' => 'Images must be uploaded as an array.',
            'images.min' => 'You must upload at least 1 image.',
            'images.max' => 'You cannot upload more than 10 images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each file must be of type: jpg, jpeg, png.',
            'categories.required' => 'You must select at least one category.',
            'categories.array' => 'Categories must be an array.',
            'categories.min' => 'You must select at least one category.',
            'categories.*.integer' => 'Each category must be a valid integer.',
            'categories.*.exists' => 'Selected category does not exist.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'url_shopee' => $request->input('url_shopee'),
            ]);

            $product->categories()->attach($request->input('categories'));

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $slug = str_replace('-', '_', $product->slug);
                $thumbnailName = 'thumbnail_' . $slug . sha1(mt_rand(1, 999999) . microtime()) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnailPath = $thumbnail->storeAs('products/thumbnails', $thumbnailName, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $thumbnailPath,
                    'is_thumbnail' => true,
                ]);
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $slug = str_replace('-', '_', $product->slug);
                    $imageName = 'image_' . $slug . sha1(mt_rand(1, 999999) . microtime()) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products/images', $imageName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $imagePath,
                        'is_thumbnail' => false,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('product.show', ['product' => $product->slug])->with('success', 'Product successfully saved.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('product.index'))->with('error', 'An error occurred while saving data.');
        }
    }

    public function show(Product $product)
    {
        $products = Product::with(['thumbnail', 'categories'])
            ->orderByDesc('updated_at')
            ->latest('created_at')
            ->get();

        $currentIndex = $products->search(function ($item) use ($product) {
            return $item->id === $product->id;
        });

        $previousProduct = $products->get($currentIndex - 1);
        $nextProduct = $products->get($currentIndex + 1);

        return view('admin.pages.product.show', compact('product', 'previousProduct', 'nextProduct'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admin.pages.product.edit', compact('product', 'categories'));
    }

    public function update(Product $product, Request $request)
    {
        $rules = [
            'numberImages' => 'required|integer|min:1|max:10',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:225',
            'price' => 'required',
            'url_shopee' => 'required|url',
            'description' => 'required|string',
            'images' => 'nullable|array|min:1|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png',
            'categories' => 'required|array|min:1',
            'categories.*' => 'integer|exists:categories,id',
        ];

        $messages = [
            'thumbnail.required' => 'Product thumbnail is required.',
            'thumbnail.image' => 'Product thumbnail must be an image.',
            'thumbnail.mimes' => 'Product thumbnail must be a file of type: jpg, jpeg, png.',
            'name.required' => 'Product name is required.',
            'name.string' => 'Product name must be text.',
            'name.max' => 'Product name should not exceed 225 characters.',
            'price.required' => 'Product price is required.',
            'url_shopee.required' => 'Shopee URL is required.',
            'url_shopee.url' => 'Shopee URL must be a valid URL.',
            'description.required' => 'Product description is required.',
            'description.string' => 'Product description must be text.',
            'images.required' => 'At least one image is required.',
            'images.array' => 'Images must be uploaded as an array.',
            'images.min' => 'You must upload at least 1 image.',
            'images.max' => 'You cannot upload more than 10 images.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each file must be of type: jpg, jpeg, png.',
            'categories.required' => 'You must select at least one category.',
            'categories.array' => 'Categories must be an array.',
            'categories.min' => 'You must select at least one category.',
            'categories.*.integer' => 'Each category must be a valid integer.',
            'categories.*.exists' => 'Selected category does not exist.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $newName = $request->input('name');
            $slug = $product->slug;

            if ($newName !== $product->name) {
                $slug = Str::slug($newName);
            }

            $product->update([
                'name' => $newName,
                'slug' => $slug,
                'price' => $request->input('price'),
                'description' => $request->input('description'),
                'url_shopee' => $request->input('url_shopee'),
            ]);

            $product->categories()->sync($request->input('categories'));

            // Thumbnail
            if (!$request->input('old_thumbnail')) {
                $existingThumbnail = ProductImage::where('product_id', $product->id)
                    ->where('is_thumbnail', true)
                    ->first();

                if ($existingThumbnail) {
                    Storage::disk('public')->delete($existingThumbnail->path);
                    $existingThumbnail->delete();
                }
            }

            if ($request->hasFile('thumbnail')) {
                $thumbnail = $request->file('thumbnail');
                $slug = str_replace('-', '_', $product->slug);
                $thumbnailName = 'thumbnail_' . $slug . sha1(mt_rand(1, 999999) . microtime()) . '.' . $thumbnail->getClientOriginalExtension();
                $thumbnailPath = $thumbnail->storeAs('products/thumbnails', $thumbnailName, 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $thumbnailPath,
                    'is_thumbnail' => true,
                ]);
            }

            // Images
            $oldImages = $request->input('old_images', []);

            $oldImageIds = array_map(function ($json) {
                $decoded = json_decode($json, true);
                return $decoded['id'] ?? null;
            }, $oldImages);

            $oldImageIds = array_filter($oldImageIds);

            $existingImages = ProductImage::where('product_id', $product->id)
                ->where('is_thumbnail', false)
                ->get();

            foreach ($existingImages as $existingImage) {
                if (!in_array($existingImage->id, $oldImageIds)) {
                    Storage::disk('public')->delete($existingImage->path);
                    $existingImage->delete();
                }
            }

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $slug = str_replace('-', '_', $product->slug);
                    $imageName = 'image_' . $slug . sha1(mt_rand(1, 999999) . microtime()) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('products/images', $imageName, 'public');

                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $imagePath,
                        'is_thumbnail' => false,
                    ]);
                }
            }

            DB::commit();

            return redirect(route('product.show', ['product' => $product->slug]))->with('success', 'Product successfully updated.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('product.index'))->with('error', 'An error occurred while updating data.');
        }
    }

    public function destroy(Product $product, Request $request)
    {
        if ($request->input('name_confirmation') !== $product->name) {
            return redirect()->back()->with('error', 'Confirmed name does not match product name.');
        }

        DB::beginTransaction();

        try {
            $product->categories()->detach();

            Storage::disk('public')->delete($product->thumbnail->path);
            $product->thumbnail->delete();

            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            }

            if ($product->testimonies) {
                foreach ($product->testimonies as $testimony) {
                    $testimony->delete();
                }
            }

            $product->delete();

            DB::commit();

            return redirect(route('product.index'))->with('success', 'Product successfully deleted.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('product.index'))->with('error', 'An error occurred while deleting data.');
        }
    }
}
