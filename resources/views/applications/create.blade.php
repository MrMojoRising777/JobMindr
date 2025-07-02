@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Add application</h3>

            <form method="POST" action="{{ route('applications.store') }}">
                @csrf

                <div class="row">
                    <div class="col-12">
                        <h5>Company</h5>
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="company[name]" placeholder="Name" required value="{{ old('company[name]') }}">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="company[sector]" placeholder="Sector" required value="{{ old('company[sector]') }}">
                    </div>

                    <div class="col-3">
                        <input type="url" class="form-control" name="company[website]" placeholder="Website" value="{{ old('company[website]') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <input type="text" class="form-control" name="company[street]" placeholder="Street" required value="{{ old('company[street]') }}">
                    </div>

                    <div class="col-1">
                        <input type="text" class="form-control" name="company[housenr]" placeholder="Housnr" required value="{{ old('company[housenr]') }}">
                    </div>

                    <div class="col-1">
                        <input type="text" class="form-control" name="company[zipcode]" placeholder="Zipcode" required value="{{ old('company[zipcode]') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="company[city]" placeholder="City" required value="{{ old('company[city]') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="company[region]" placeholder="Region" required value="{{ old('company[region]') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="company[country]" placeholder="Country" required value="{{ old('company[country]') }}">
                    </div>
                </div>

                <hr class="hr" />

                <div class="row">
                    <div class="col-12">
                        <h5>Contact</h5>
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="contact[first_name]" placeholder="First name" required value="{{ old('contact[first_name]') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="contact[last_name]" placeholder="Last name" required value="{{ old('contact[last_name]') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <input type="email" class="form-control" name="contact[email]" placeholder="Email" required value="{{ old('contact[email]') }}">
                    </div>

                    <div class="col-2">
                        <input type="tel" class="form-control" name="contact[phone]" placeholder="Phone" required value="{{ old('contact[phone]') }}">
                    </div>

                    <div class="col-2">
                        <input type="url" class="form-control" name="contact[linkedin]" placeholder="Linkedin" value="{{ old('contact[linkedin]') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <input type="text" class="form-control" name="contact[position]" placeholder="Position" required value="{{ old('contact[position]') }}">
                    </div>
                </div>

                <hr class="hr" />

                <div class="row">
                    <div class="col-12">
                        <h5>Job</h5>
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="application[position]" placeholder="Title" value="{{ old('position') }}">
                    </div>

                    <div class="col-3">
                        <input type="url" class="form-control" name="application[website]" placeholder="Website">
                    </div>

                    <div class="col-1"></div>

                    <div class="col-4">
                        <input type="hidden" name="application[notes]" id="hidden-description">

                        <div id="editor" >
                            {!! old('application.notes') !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-2">
                        <select class="form-select" name="application[company_id]">
                            <option value="" disabled {{ old('company_id') ? '' : 'selected' }}>Select a company</option>
                            @forelse($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @empty
                                <option value="" selected disabled>No companies found</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i>
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
