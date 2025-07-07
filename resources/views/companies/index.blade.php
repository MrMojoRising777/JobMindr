@extends('layouts.app')

@section('content')
    <a href="{{ route('companies.create') }}" class="btn btn-info text-white">
        Create
    </a>

    <table class="table table-hover" id="table-container">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Sector</th>
                <th scope="col">Region</th>
                <th scope="col">Country</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr class="pointer" data-href="{{ route('companies.show', ['company' => $company]) }}">
                    <th scope="row">{{ $company->id }}</th>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->sector }}</td>
                    <td>{{ $company->region }}</td>
                    <td>{{ $company->country }}</td>
                </tr>
            @empty
                <tr>
                    <th scope="row">x</th>
                    <td colspan="2">No companies found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $companies->links() }}
@endsection
