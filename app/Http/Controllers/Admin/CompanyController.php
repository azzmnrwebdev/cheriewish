<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        return view('admin.pages.company.index');
    }

    public function store(Request $request)
    {
        dd($request->all());
        $rules = [
            'name' => 'required|string|max:225',
            'email' => 'required|email|string|max:225',
            'address' => 'nullable|string',
        ];

        $messages = [
            'name.required' => 'Company name is required.',
            'name.string' => 'Company name must be text.',
            'name.max' => 'Company name should not exceed 225 characters.',
            'email.required' => 'Company email is required.',
            'email.email' => 'Invalid company email address.',
            'email.string' => 'Company email must be text.',
            'email.max' => 'Company email should not exceed 225 characters.',
            'address.string' => 'Company address must be text.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            session()->flash('open_modal', 'formCreateModal');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            DB::commit();

            return redirect(route('company.index'))->with('success', 'Company successfully saved.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('company.index'))->with('error', 'An error occurred while saving data.');
        }
    }
}
