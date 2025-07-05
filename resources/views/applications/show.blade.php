@extends('layouts.app')

@section('content')
    @php
        $status = strtolower($application->status);
        $badgeClass = match ($status) {
            'applied'   => 'text-bg-warning',
            'interview' => 'text-bg-info',
            'rejected'  => 'text-bg-danger',
            'accepted'  => 'text-bg-success',
            default     => 'text-bg-secondary',
        };
    @endphp

    <div class="row">
        <div class="col-2">
            <a class="btn btn-primary" href="" data-bs-toggle="modal" data-bs-target="#contactModal">
                <i class="bi bi-pen"></i>
                Edit Contact
            </a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <h2 class="card-title">
                                {{ $application->position }} @ {{ $application->company->name }}
                                <span class="text-end">
                            <span class="badge {{ $badgeClass }} fs-6">{{ ucfirst($application->status) }}</span>
                        </span>
                            </h2>

                            <span>{{ $application->applied_at }}</span>

                            <hr class="hr mb-0" />

                            <span class="text-danger">
                        <i class="bi bi-briefcase"></i> Remote - full-time - entry level |
                        <i class="bi bi-currency-euro"></i> 2.500-3.000 |
                        <i class="bi bi-link-45deg"></i> <a href="{{ $application->link }}" target="_blank">original link</a>
                    </span>
                        </div>

                        <div class="col-3 text-end pe-5">
                            <img class="img-thumbnail rounded-circle" width="100" src="https://haieng.com/wp-content/uploads/2017/10/test-image-500x500.jpg" alt="test img">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <span>{{ $application->description }}</span>
                        </div>

                        <div class="col-3"></div>

                        <div class="col-3">
                            <span class="fs-4">{{ $application->company->contact?->full_name }}</span>
                            <br />
                            <span class="fs-6 text-secondary-emphasis">{{ $application->company->contact?->position }}</span>

                            <table class="table">
                                <tr>
                                    <td>
                                        <i class="bi bi-envelope"></i>
                                    </td>
                                    <td>{{ $application->company->contact?->email }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <i class="bi bi-telephone"></i>
                                    </td>
                                    <td>{{ $application->company->contact?->phone }}</td>
                                </tr>
                                @if($application->company->contact?->linkedin)
                                    <tr>
                                        <td>
                                            <i class="bi bi-linkedin"></i>
                                        </td>
                                        <td>
                                            <a href="{{ $application->company->contact->linkedin }}" target="_blank">
                                                {{ $application->company->contact->linkedin }}
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                    <span class="fs-3">
                        Activity history here
                    </span>
                        </div>

                        <div class="col-4">
                            <span class="fs-3">Personal notes</span>

                            <input type="hidden" name="application[notes]" id="hidden-description">

                            <div id="editor" >
                                {!! $application->notes !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.contactModal', ['contact' => $application->company->contact, 'company' => $application->company])
@endsection
