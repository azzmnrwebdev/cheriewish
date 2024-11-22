<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Product;
use App\Models\Testimony;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TestimonyController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $query = Testimony::query();
        $search = $request->input('search');
        $productSlug = $request->input('product');

        if ($productSlug) {
            $query->whereHas('product', function ($q) use ($productSlug) {
                $q->where('slug', $productSlug);
            });
        }

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $testimonies = $query->with('product')->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.testimony.index', compact('products', 'productSlug', 'search', 'testimonies'));
    }

    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:225',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
        ];

        $messages = [
            'product_id.required' => 'You must select one product.',
            'product_id.integer' => 'Each product must be a valid integer.',
            'product_id.exists' => 'Selected product does not exist.',
            'name.required' => 'People name is required.',
            'name.string' => 'People name must be text.',
            'name.max' => 'People name should not exceed 225 characters.',
            'description.required' => 'Review is required.',
            'description.string' => 'Review must be text.',
            'stars.required' => 'Value is required.',
            'stars.integer' => 'Value must be a number.',
            'stars.min' => 'Value must be at least 1.',
            'stars.max' => 'Value cannot exceed 5.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            session()->flash('open_modal', 'formCreateModal');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Testimony::create([
                'product_id' => $request->input('product_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'stars' => $request->input('stars'),
            ]);

            return redirect(route('testimony.index'))->with('success', 'Testimony successfully saved.');
        } catch (Exception $e) {
            return redirect(route('testimony.index'))->with('error', 'An error occurred while saving data.');
        }
    }

    public function update(Testimony $testimony, Request $request)
    {
        $rules = [
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:225',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
        ];

        $messages = [
            'product_id.required' => 'You must select one product.',
            'product_id.integer' => 'Each product must be a valid integer.',
            'product_id.exists' => 'Selected product does not exist.',
            'name.required' => 'People name is required.',
            'name.string' => 'People name must be text.',
            'name.max' => 'People name should not exceed 225 characters.',
            'description.required' => 'Review is required.',
            'description.string' => 'Review must be text.',
            'stars.required' => 'Value is required.',
            'stars.integer' => 'Value must be a number.',
            'stars.min' => 'Value must be at least 1.',
            'stars.max' => 'Value cannot exceed 5.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            session()->flash('open_modal', 'formEditModal');
            session()->flash('route_name', route('testimony.update', ['testimony' => $testimony->id]));
            session()->flash('title', $testimony->name);
            session()->flash('product_id', $request->input('product_id'));
            session()->flash('name', $request->input('name'));
            session()->flash('description', $request->input('description'));
            session()->flash('stars', $request->input('stars'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $testimony->update([
                'product_id' => $request->input('product_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'stars' => $request->input('stars'),
            ]);

            return redirect(route('testimony.index'))->with('success', 'Testimony successfully updated.');
        } catch (Exception $e) {
            return redirect(route('testimony.index'))->with('error', 'An error occurred while updating data.');
        }
    }

    public function destroy(Testimony $testimony)
    {
        try {
            $testimony->delete();

            return redirect(route('testimony.index'))->with('success', 'Testimony successfully deleted.');
        } catch (Exception $e) {
            return redirect(route('testimony.index'))->with('error', 'An error occurred while deleting data.');
        }
    }
}
