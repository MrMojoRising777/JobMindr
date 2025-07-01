<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Company;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::with('company')->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('contacts.create', compact('companies'));
    }

    public function store(StoreContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        return redirect()->route('contacts.show', $contact)->with('success', 'Contact created!');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }
}
