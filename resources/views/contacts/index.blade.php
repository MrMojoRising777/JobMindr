@extends('layouts.app')

@section('content')
    <a href="{{ route('contacts.create') }}" class="btn btn-info text-white">
        Create
    </a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Company</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
            </tr>
        </thead>
        <tbody>
            @forelse($contacts as $contact)
                <tr class="pointer" data-href="{{ route('contacts.show', ['contact' => $contact]) }}">
                    <th scope="row">{{ $contact->id }}</th>
                    <td>{{ $contact->company->name }}</td>
                    <td>{{ $contact->full_name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                </tr>
            @empty
                <tr>
                    <th scope="row">x</th>
                    <td colspan="4">No contacts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {!! $contacts->links() !!}
@endsection
