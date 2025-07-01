@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add company</h5>

            <div class="container">
                <form method="POST" action="{{ route('companies.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-3">
                            <input type="text" class="form-control" name="name" placeholder="Company name" value="{{ old('name') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <input type="text" class="form-control" name="street" placeholder="Street" value="{{ old('street') }}">
                        </div>

                        <div class="col-2">
                            <input type="text" class="form-control" name="housenr" placeholder="Housenr" value="{{ old('housenr') }}">
                        </div>

                        <div class="col-2">
                            <input type="text" class="form-control" name="zipcode" placeholder="Zipcode" value="{{ old('zipcode') }}">
                        </div>

                        <div class="col-2">
                            <input type="text" class="form-control" name="city" placeholder="City" value="{{ old('city') }}">
                        </div>

                        <div class="col-2">
                            <input type="text" class="form-control" name="region" placeholder="Region" value="{{ old('region') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="input-group">
                                <span class="input-group-text" id="website"><i class="bi bi-link"></i></span>
                                <input type="text" class="form-control" name="website" placeholder="Website" value="{{ old('website') }}">
                            </div>
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
    </div>
@endsection
