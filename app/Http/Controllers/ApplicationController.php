<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use App\Models\Company;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('company')->paginate(10);

        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        $companies = Company::all();
        $contacts = Contact::all();

        return view('applications.create', compact('companies', 'contacts'));
    }

    public function store(StoreApplicationRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $data['status'] = 'sent';
        $data['applied_at'] = Carbon::now()->toDateString();

        $application = Application::create($data);

        return redirect()->route('applications.show', $application)->with('success', 'Application created!');
    }

    public function show(Application $application)
    {
        $application->load(['company', 'contact']);

        return view('applications.show', compact('application'));
    }
}
