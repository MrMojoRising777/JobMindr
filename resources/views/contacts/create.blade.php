@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add contact</h5>

            <div class="container">
                <form method="POST" action="{{ route('contacts.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-3">
                            <select class="form-select" name="company_id">
                                <option value="" selected disabled>Select a company</option>
                                @forelse($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @empty
                                    <option value="" selected>No companies found</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <input type="text" class="form-control" name="first_name" placeholder="First name" value="{{ old('first_name') }}">
                        </div>

                        <div class="col-3">
                            <input type="text" class="form-control" name="last_name" placeholder="Last name" value="{{ old('last_name') }}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-3">
                            <div class="input-group">
                                <span class="input-group-text" id="email">@</span>
                                <input type="text" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="input-group">
                                <span class="input-group-text" id="phone"><i class="bi bi-telephone"></i></span>
                                <input type="tel" class="form-control" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2">
                            <input type="text" class="form-control" name="position" placeholder="Position" value="{{ old('position') }}">
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
