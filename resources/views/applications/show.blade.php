@extends('layouts.app')

@section('content')
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            @include('components.favorite-btn', ['model' => $application])

                            <h2 class="card-title ms-4">
                                {{ $application->position }} @ {{ $application->company->name }}
                                <span class="text-end">
                                    <span class="badge {{ $application->status->badgeClass() }} fs-6">
                                        {{ $application->status->label() }}
                                    </span>
                                </span>
                            </h2>

                            <span class="ms-4">{{ $application->applied_at }}</span>

                            <hr class="hr mb-0"/>

                            <span class="text-danger">
                                <i class="bi bi-briefcase"></i> Remote - full-time - entry level |
                                <i class="bi bi-currency-euro"></i> 2.500-3.000 |
                                <i class="bi bi-link-45deg"></i> <a href="{{ $application->link }}" target="_blank">original link</a>
                            </span>
                        </div>

                        <div class="col-3 text-end pe-5">
                            <img class="img-thumbnail rounded-circle" width="100"
                                 src="https://haieng.com/wp-content/uploads/2017/10/test-image-500x500.jpg"
                                 alt="test img">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <span>empty</span>
                        </div>

                        <div class="col-3"></div>

                        <div class="col-3">
                            <span class="fs-4">{{ $application->company->contact?->full_name }}</span>
                            <br/>
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
                            <ul>
                                @foreach ($application->activities as $activity)
                                    <li>
                                        {{ $activity->created_at->format('Y-m-d') }} -

                                        @if ($activity->description === 'Status updated' && isset($activity->properties['attributes']['status']))
                                            @php
                                                $statusValue = $activity->properties['attributes']['status'];
                                                $statusEnum = \App\Enums\ApplicationStatus::tryFrom($statusValue);
                                            @endphp

                                            Status updated to
                                            <span class="{{ $statusEnum->badgeClass() }}">
                                                {{ $statusEnum->label() }}
                                            </span>

                                            @if ($statusValue === 'rejected' && isset($activity->properties['attributes']['reason']))
                                                - <span class="fw-semibold text-danger text-decoration-underline">
                                                    {{
                                                        \App\Enums\ApplicationRejectionReason::tryFrom($activity->properties['attributes']['reason'])?->label()
                                                        ?? ucfirst($activity->properties['attributes']['reason'])
                                                    }}
                                                </span>
                                            @endif
                                        @else
                                            {{ $activity->description }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-4">
                            @if($application->notes)
                                <span class="fs-3">Personal notes</span>

                                <input type="hidden" name="application[notes]" id="hidden-description">

                                <div id="editor">
                                    {!! $application->notes !!}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <a class="btn btn-primary" href="" data-bs-toggle="modal" data-bs-target="#applicationModal">
                                <i class="bi bi-pen"></i>
                                Edit Application
                            </a>
                        </div>

                        <div class="col-2">
                            <a class="btn btn-primary" href="" data-bs-toggle="modal" data-bs-target="#contactModal">
                                <i class="bi bi-pen"></i>
                                Edit Contact
                            </a>
                        </div>

                        <div class="col-2">
                            <a class="btn btn-primary" href="" data-bs-toggle="modal" data-bs-target="#companyModal">
                                <i class="bi bi-pen"></i>
                                Edit Company
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.editApplication', ['application' => $application])
    @include('modals.editContact', ['contact' => $application->company->contact, 'company' => $application->company])
    @include('modals.editCompany', ['company' => $application->company])
@endsection
