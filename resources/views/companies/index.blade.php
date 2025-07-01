@extends('layouts.app')

@section('content')
    <a href="{{ route('companies.create') }}" class="btn btn-info text-white">
        Create
    </a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Region</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <th scope="row">{{ $company->id }}</th>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->region }}</td>
                </tr>
            @empty
                <tr>
                    <th scope="row">x</th>
                    <td colspan="2">No companies found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
