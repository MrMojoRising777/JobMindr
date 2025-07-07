<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use App\Models\Company;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApplicationController extends Controller
{
    public function index(): View
    {
        $applications = Application::with('company')->where('status', 'applied')->paginate(10);

        $regions = Company::whereHas('applications')
            ->whereNotNull('region')
            ->where('region', '!=', '')
            ->distinct()
            ->orderBy('region')
            ->pluck('region');

        return view('applications.index', compact('applications', 'regions'));
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
        $contact = null;

        $data['contact']['company_id'] = $company->id;

        if (!empty($data['contact']['first_name']) && !empty($data['contact']['last_name'])) {
            $contact = Contact::create([
                'first_name' => $data['contact']['first_name'],
                'last_name'  => $data['contact']['last_name'],
                'email'      => $data['contact']['email'],
                'phone'      => $data['contact']['phone'],
                'linkedin'   => $data['contact']['linkedin'],
                'position'   => $data['contact']['position'],
                'company_id' => $data['contact']['company_id'],
            ]);
        }

        $data['application']['company_id'] = $company->id;
        $data['application']['contact_id'] = $contact?->id ?? null;
        $data['application']['description'] = ''; // TODO not hardcode
        $data['application']['found_on'] = 'Linkedin'; // TODO not hardcode
        $data['application']['user_id'] = Auth::id();
        $data['application']['status'] = 'applied';
        $data['application']['applied_at'] = Carbon::now()->toDateString();
        $data['application']['link'] = $data['application']['website'];

        $application = Application::create($data['application']);

        return redirect()->route('applications.show', $application)->with('success', 'Application created!');
    }

    public function show(Application $application): View
    {
        $application->load(['company.contact']);
        $statuses = ApplicationStatus::cases();

        return view('applications.show', compact('application', 'statuses'));
    }

    public function update(UpdateApplicationRequest $request, Application $application): RedirectResponse
    {
        $data = $request->validated();

        $updateData = $data;

        unset($updateData['application_id']);

        if (isset($updateData['notes']) && $updateData['notes'] !== null) {
            $updateData['notes'] = $application->notes . '<br><br>' . $updateData['notes'];
        } else {
            $updateData['notes'] = $application->notes;
        }

        $application->update($updateData);

        return redirect()->route('applications.show', $application)->with('success', 'Application updated!');
    }

    public function filter(Request $request): string
    {
        $query = Application::query()->with('company');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('region')) {
            $query->whereHas('company', function ($q) use ($request) {
                $q->where('region', 'like', '%' . $request->region . '%');
            });
        }

        $applications = $query->latest()->paginate(10);

        return view('applications.partials.table', compact('applications'))->render();
    }

}
