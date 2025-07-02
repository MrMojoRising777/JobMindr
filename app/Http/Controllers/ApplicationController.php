<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Company;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $applications = Application::with('company')->paginate(10);

        return view('applications.index', compact('applications'));
    }

    public function create(): View
    {
        $companies = Company::all();
        $contacts = Contact::all();

        return view('applications.create', compact('companies', 'contacts'));
    }

    public function store(StoreApplicationRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $company = Company::create($data['company']);

        $data['contact']['company_id'] = $company->id;
        $contact = Contact::create($data['contact']);

        $data['application']['company_id'] = $company->id;
        $data['application']['contact_id'] = $contact->id;
        $data['application']['description'] = ''; // TODO not hardcode
        $data['application']['found_on'] = 'Linkedin'; // TODO not hardcode
        $data['application']['user_id'] = Auth::id();
        $data['application']['status'] = 'applied';
        $data['application']['applied_at'] = Carbon::now()->toDateString();

        $application = Application::create($data['application']);

        return redirect()->route('applications.show', $application)->with('success', 'Application created!');
    }

    public function show(Application $application): View
    {
        $application->load(['company.contact']);

        return view('applications.show', compact('application'));
    }
}
