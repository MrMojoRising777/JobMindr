@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ $application->position }} @ {{ $application->company->name }}
                <span class="text-end">
                    <span class="badge text-bg-secondary">{{ $application->status }}</span>
                </span>
            </h5>

            <hr class="hr" />

            <div class="row">
                <div class="col-3">
                    <span>{{ $application->contact->full_name ?? 'N/A' }}</span>

                    <table class="table">
                        <tr>
                            <td>
                                <i class="bi bi-envelope"></i>
                            </td>
                            <td>{{ $application->contact->email }}</td>
                        </tr>
                        <tr>
                            <td>
                                <i class="bi bi-telephone"></i>
                            </td>
                            <td>{{ $application->contact->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <p class="small-text">Notes</p>
                    <span>{{ $application->notes }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
