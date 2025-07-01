@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add application</h5>

            <form method="POST" action="{{ route('applications.store') }}">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <select class="form-select" name="company_id">
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
                    <div class="col-6">
                        <input type="text" class="form-control" name="position" placeholder="Position" value="{{ old('position') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-6">
                        <textarea class="form-control" name="notes" placeholder="Write your notes here" id="textarea">{{ old('notes') }}</textarea>
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
