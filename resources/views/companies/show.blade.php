@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            @include('components.favorite-btn', ['model' => $company])

            <form action="{{ route('companies.store', ['company' => $company]) }}" method="POST">
                @csrf
                <h2 class="card-title ms-4">{{ $company->name }}</h2>

                <div class="row">
                    <div class="col-4">
                        <input type="text" class="form-control" name="name" value="{{ $company->name ?? old('name') }}">
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" name="sector" value="{{ $company->sector ?? old('sector') }}" placeholder="Sector">
                    </div>

                    <div class="col-4">
                        <input type="text" class="form-control" name="website" value="{{ $company->website ?? old('website') }}" placeholder="Website">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <input type="text" class="form-control" name="street" id="street" value="{{ $company->street ?? old('street') }}" placeholder="Street">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="housenr" id="housenr" value="{{ $company->housenr ?? old('housenr') }}" placeholder="Housenr">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <input type="text" class="form-control" name="zipcode" id="zipcode" value="{{ $company->zipcode ?? old('zipcode') }}" placeholder="Zipcode">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="city" id="city" value="{{ $company->city ?? old('city') }}" placeholder="City">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="region" id="region" value="{{ $company->region ?? old('region') }}" placeholder="Region">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="country" id="country" value="{{ $company->country ?? old('country') }}" placeholder="country">
                    </div>
                </div>

                <hr class="hr" />

                <div class="row">
                    <div class="col-12">
                        <h3 class="font-bold">Contact</h3>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <input type="text" class="form-control" name="contact['first_name']" value="{{ $company->contact->first_name ?? old("contact['first_name']") }}" placeholder="First name">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="contact['last_name']" value="{{ $company->contact->last_name ?? old("contact['last_name']") }}" placeholder="Last name">
                    </div>

                    <div class="col-3">
                        <input type="text" class="form-control" name="contact['last_name']" value="{{ $company->contact->last_name ?? old("contact['last_name']") }}" placeholder="Last name">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" class="form-control" name="contact['email']" value="{{ $company->contact->email ?? old("contact['email']") }}" placeholder="Email">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="tel" class="form-control" name="contact['phone']" value="{{ $company->contact->phone ?? old("contact['phone']") }}" placeholder="Phone">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-linkedin"></i></span>
                            <input type="url" class="form-control" name="contact['linkedin']" value="{{ $company->contact->linkedin ?? old("contact['linkedin']") }}" placeholder="Linkedin">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
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
