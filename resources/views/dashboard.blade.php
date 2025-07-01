@extends('layouts.app')

@section('header')
    <h2 class="fw-semibold fs-4 text-dark">
        {{ __('Dashboard') }}
    </h2>
@endsection

@section('content')
    <div class="card shadow-sm rounded">
        <div class="card-body text-dark">
            {{ __("You're logged in!") }}
        </div>
    </div>
@endsection
