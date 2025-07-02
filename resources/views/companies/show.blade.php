@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $company->name }}</h2>

            <div class="row">
                <div class="col-12">
                    <span>{{ $company->street }} {{ $company->housenr }}</span>
                </div>
                <div class="col-12">
                    <span>{{ $company->city }} {{ $company->zipcode }}</span>
                </div>
                <div class="col-12">
                    <span>{{ $company->country }}</span>
                </div>
            </div>

            <hr class="hr" />

            <div class="row">
                <div class="col-3">
                    <h3 class="font-bold">Contact</h3>

                    @if($company->contact)
                        <span class="fs-4">{{ $company->contact->full_name }}</span>
                        <br />
                        <span class="fs-6 text-secondary-emphasis">{{ $company->contact->position }}</span>

                        <table class="table">
                            <tr>
                                <td>
                                    <i class="bi bi-envelope"></i>
                                </td>
                                <td>{{ $company->contact->email }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="bi bi-telephone"></i>
                                </td>
                                <td>{{ $company->contact->phone }}</td>
                            </tr>
                            @if($company->contact->linkedin)
                                <tr>
                                    <td>
                                        <i class="bi bi-linkedin"></i>
                                    </td>
                                    <td>
                                        <a href="{{ $company->contact->linkedin }}" target="_blank">
                                            {{ $company->contact->linkedin }}
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    @else
                        <span>No contact found</span>
                    @endif
                </div>

                <div class="col-6"></div>
            </div>
        </div>
    </div>
@endsection
