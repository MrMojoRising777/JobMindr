<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::with('company')->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create(): View
    {
        $companies = Company::all();
        return view('contacts.create', compact('companies'));
    }

    public function storeOrUpdate(StoreContactRequest $request, Contact $contact = null): RedirectResponse
    {
        if ($contact) {
            $contact->update($request->validated());
            return redirect()->back()->with('success', 'Contact updated!');
        }

        $contact = Contact::create($request->validated());

        return redirect()->route('contacts.show', $contact)->with('success', 'Contact created!');
    }

    public function show(Contact $contact): View
    {
        return view('contacts.show', compact('contact'));
    }
}
