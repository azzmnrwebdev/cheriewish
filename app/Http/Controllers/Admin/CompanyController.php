<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\About;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $company = Company::latest()->first();
        $about = About::latest()->first();

        return view('admin.pages.company.index', compact('company', 'about'));
    }

    public function form()
    {
        $company = Company::latest()->first();
        $about = About::latest()->first();

        return view('admin.pages.company.create', compact('company', 'about'));
    }

    public function store(Request $request)
    {
        $rules = [
            'logo' => empty($request->input('old_logo')) ? 'required|image|mimes:jpg,jpeg,png' : 'nullable|image|mimes:jpg,jpeg,png',
            'name' => 'required|string|max:225',
            'email' => 'required|email|string|max:225',
            'phone_number' => 'required|numeric',
            'shopee' => 'required|url',
            'address' => 'nullable|string',
            'title' => 'required|string|max:225',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'tiktok' => 'nullable|url',
            'twitter' => 'nullable|url',
        ];

        $messages = [
            'logo.required' => 'Company logo is required.',
            'logo.image' => 'Company logo must be an image.',
            'logo.mimes' => 'Company logo must be a file of type: jpg, jpeg, png.',
            'name.required' => 'Company name is required.',
            'name.string' => 'Company name must be text.',
            'name.max' => 'Company name should not exceed 225 characters.',
            'email.required' => 'Company email is required.',
            'email.email' => 'Invalid company email address.',
            'email.string' => 'Company email must be text.',
            'email.max' => 'Company email should not exceed 225 characters.',
            'phone_number.required' => 'Whatsapp number is required.',
            'phone_number.numeric' => 'Whatsapp number must be number.',
            'shopee.required' => 'Shopee URL is required.',
            'shopee.url' => 'Shopee URL is invalid.',
            'address.string' => 'Company address must be text.',
            'title.required' => 'Page title is required.',
            'title.string' => 'Page title must be text.',
            'title.max' => 'Page title should not exceed 225 characters.',
            'short_description.required' => 'Short description is required.',
            'short_description.string' => 'Short description must be text.',
            'description.required' => 'Long description is required.',
            'description.string' => 'Long description must be text.',
            'facebook.url' => 'Facebook URL is invalid.',
            'instagram.url' => 'Instagram URL is invalid.',
            'tiktok.url' => 'TikTok URL is invalid.',
            'twitter.url' => 'Twitter URL is invalid.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            if ($request->hasFile('logo')) {
                Storage::disk('public')->delete(Company::find($request->input('companyId'))->logo);

                $logo = $request->file('logo');
                $logoName = 'logo_' . sha1(mt_rand(1, 999999) . microtime()) . '.' . $logo->getClientOriginalExtension();
                $logoPath = $logo->storeAs('logo', $logoName, 'public');
            }

            Company::updateOrCreate(
                ['id' => $request->input('companyId')],
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'shopee' => $request->input('shopee'),
                    'facebook' => $request->input('facebook'),
                    'instagram' => $request->input('instagram'),
                    'tiktok' => $request->input('tiktok'),
                    'twitter' => $request->input('twitter'),
                    'address' => $request->input('address'),
                    'logo' => $logoPath ?? $request->input('old_logo'),
                ]
            );

            About::updateOrCreate(
                ['id' => $request->input('aboutId')],
                [
                    'title' => $request->input('title'),
                    'short_description' => $request->input('short_description'),
                    'description' => $request->input('description'),
                ]
            );

            DB::commit();

            return redirect(route('company.index'))->with('success', 'Company successfully saved.');
        } catch (Exception $e) {
            DB::rollBack();

            return redirect(route('company.index'))->with('error', 'An error occurred while saving data.');
        }
    }
}
