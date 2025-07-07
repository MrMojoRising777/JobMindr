<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    public function index(): View
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function storeOrUpdate(StoreCompanyRequest $request, Company $company = null): RedirectResponse
    {
        if ($company) {
            $company->update($request->validated());
            return redirect()->back()->with('success', 'Company updated!');
        }

        $company = Company::create($request->validated());

        return redirect()->route('companies.show', $company)->with('success', 'Company created!');
    }

    public function show(Company $company): View
    {
        return view('companies.show', compact('company'));
    }
}
