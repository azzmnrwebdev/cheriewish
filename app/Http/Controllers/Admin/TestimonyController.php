<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Validator;

class TestimonyController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::all();
        $query = Testimony::query();
        $search = $request->input('search');

        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        $testimonies = $query->with('product')->orderByDesc('updated_at')->latest('created_at')->paginate(10);

        return view('admin.pages.testimony.index', compact('products', 'search', 'testimonies'));
    }

    public function store(Request $request)
    {
        $rules = [
            'product_id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:225',
            'description' => 'required|string',
            'stars' => 'required',
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
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            session()->flash('open_modal', 'formCreateModal');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            Testimony::create([
                'product_id' => $request->input('product_id'),
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'stars' => $request->input('stars'),
            ]);

            DB::commit();

            return redirect(route('testimony.index'))->with('success', 'Testimony successfully saved.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('testimony.index'))->with('error', 'An error occurred while saving data.');
        }
    }

    public function show(Testimony $testimony)
    {
        //
    }

    public function edit(Testimony $testimony)
    {
        //
    }

    public function update(Testimony $testimony, Request $request)
    {
        //
    }

    public function destroy(Testimony $testimony, Request $request)
    {
        //
    }
}
