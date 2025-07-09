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

{{--                    <div class="row">--}}
{{--                        <div class="col-2">--}}
{{--                            <select class="form-select" name="application[company_id]">--}}
{{--                                <option value="" disabled {{ old('company_id') ? '' : 'selected' }}>Select a company</option>--}}
{{--                                @forelse($companies as $company)--}}
{{--                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>--}}
{{--                                        {{ $company->name }}--}}
{{--                                    </option>--}}
{{--                                @empty--}}
{{--                                    <option value="" selected disabled>No companies found</option>--}}
{{--                                @endforelse--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-3">
                        <input type="text" class="form-control" name="company[name]" placeholder="Name" required value="{{ old('company.name') }}">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="company[sector]" placeholder="Sector" required value="{{ old('company.sector') }}">
                    </div>

                    <div class="col-3">
                        <input type="url" class="form-control" name="company[website]" placeholder="Website" value="{{ old('company.website') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <input type="text" class="form-control" name="company[street]" id="street" placeholder="Street" required value="{{ old('company.street') }}">
                    </div>

                    <div class="col-1">
                        <input type="text" class="form-control" name="company[housenr]" id="housenr" placeholder="Housnr" required value="{{ old('company.housenr') }}">
                    </div>

                    <div class="col-1">
                        <input type="text" class="form-control" name="company[zipcode]" id="zipcode" placeholder="Zipcode" required value="{{ old('company.zipcode') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="company[city]" id="city" placeholder="City" required value="{{ old('company.city') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="company[region]" id="region" placeholder="Region" required value="{{ old('company.region') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="company[country]" id="country" placeholder="Country" required value="{{ old('company.country') }}">
                    </div>
                </div>

                <hr class="hr" />

                <div class="row">
                    <div class="col-12">
                        <h5>Contact</h5>
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="contact[first_name]" placeholder="First name" value="{{ old('contact.first_name') }}">
                    </div>

                    <div class="col-2">
                        <input type="text" class="form-control" name="contact[last_name]" placeholder="Last name" value="{{ old('contact.last_name') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <input type="email" class="form-control" name="contact[email]" placeholder="Email" value="{{ old('contact.email') }}">
                    </div>

                    <div class="col-2">
                        <input type="tel" class="form-control" name="contact[phone]" placeholder="Phone" value="{{ old('contact.phone') }}">
                    </div>

                    <div class="col-2">
                        <input type="url" class="form-control" name="contact[linkedin]" placeholder="Linkedin" value="{{ old('contact.linkedin') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <input type="text" class="form-control" name="contact[position]" placeholder="Position" value="{{ old('contact.position') }}">
                    </div>
                </div>

                <hr class="hr" />

                <div class="row">
                    <div class="col-12">
                        <h5>Job</h5>
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="application[position]" placeholder="Title" required value="{{ old("application.position") }}">
                    </div>

                    <div class="col-3">
                        <input type="url" class="form-control" name="application[website]" placeholder="Website" required value="{{ old("application.website") }}">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="application[found_on]" placeholder="Found on" value="{{ old('application.found_on', 'Linkedin') }}">
                    </div>

{{--                    <div class="col-3">--}}
{{--                        <input type="hidden" name="application[notes]" id="quillInput">--}}

{{--                        <div id="quillContent">--}}
{{--                            {!! old('application.notes') !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <div class="input-group">
                            <span class="input-group-text">Min</span>
                            <input type="number" name="application[properties][salary_range][min]" class="form-control" placeholder="3000"
                                   min="0" step="100">
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="input-group">
                            <span class="input-group-text">Max</span>
                            <input type="number" name="application[properties][salary_range][max]" class="form-control" placeholder="4000"
                                   min="0" step="100">
                        </div>
                    </div>

                    <div class="col-2">
                        <select name="application[properties][job_type]" class="form-control">
                            <option value="">Job Type</option>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="contract">Contract</option>
                            <option value="internship">Internship</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <select name="application[properties][work_location]" class="form-control">
                            <option value="">Work Location</option>
                            <option value="on-site">On-site</option>
                            <option value="remote">Remote</option>
                            <option value="hybrid">Hybrid</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2">
                        <select name="application[properties][experience_level]" class="form-control">
                            <option value="">Experience Level</option>
                            <option value="junior">Junior</option>
                            <option value="medior">Medior (3-5 years)</option>
                            <option value="senior">Senior (5-7 years)</option>
                            <option value="lead">Lead (7+ years)</option>
                            <option value="none">None required</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <select name="application[properties][education_level]" class="form-control">
                            <option value="">Education Level</option>
                            <option value="high_school">High School</option>
                            <option value="bachelor">Bachelor</option>
                            <option value="master">Master</option>
                            <option value="phd">PhD</option>
                            <option value="none">None required</option>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            function fetchAddress() {
                let zipcode = $('#zipcode').val().replace(/\s+/g, '').toUpperCase();
                let housenr = $('#housenr').val().trim();

                if (zipcode.length === 6 && housenr !== '') {
                    let query = zipcode + '+' + housenr;

                    $.get('/api/address-lookup', { q: query })
                        .done(function (data) {
                            if (data.response.docs.length > 0) {
                                let result = data.response.docs[0];

                                $('#street').val(result.straatnaam || '');
                                $('#city').val(result.woonplaatsnaam || '');
                                $('#region').val(result.provincienaam || '');
                                $('#country').val('Nederland');
                            } else {
                                console.warn('Geen resultaat gevonden.');
                            }
                        })
                        .fail(function () {
                            console.error('Fout bij ophalen van adresgegevens.');
                        });
                }
            }

            $('#zipcode, #housenr').on('blur', fetchAddress);
        });
    </script>
@endpush
