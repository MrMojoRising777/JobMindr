@extends('layouts.app')

@section('content')
    <div class="row">
        <form id="filter-form">
            @csrf
            <div class="col-12">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <select name="status" class="form-control" id="filter-status">
                            <option value="">All Statuses</option>
                            <option value="applied" selected>Applied</option>
                            <option value="interview">Interview</option>
                            <option value="rejected">Rejected</option>
                            <option value="accepted">Accepted</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <select name="region" class="form-control" id="filter-region">
                            <option value="">All Regions</option>
                            @foreach($regions as $region)
                                <option value="{{ $region }}" {{ request('region') == $region ? 'selected' : '' }}>{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <a href="{{ route('applications.create') }}" class="btn btn-info text-white">
                Create
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12" id="table-container">
            @include('applications.partials.table')
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            {{ $applications->links() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function fetchFilteredApplications() {
            $.ajax({
                url: "{{ route('applications.filter') }}",
                method: 'POST',
                data: $('#filter-form').serialize(),
                success: function (data) {
                    $('#table-container').html(data);
                },
                error: function () {
                    alert('Something went wrong!');
                }
            });
        }

        $(document).ready(function () {
            $('#filter-form select, #filter-form input').on('change keyup', function () {
                fetchFilteredApplications();
            });
        });
    </script>
@endpush
