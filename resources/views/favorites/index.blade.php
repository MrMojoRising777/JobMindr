@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Favorites</h2>

            <form method="GET" action="{{ route('favorites.index') }}">
                <div class="row">
                    <div class="col-2">
                        <select name="model" class="form-control" onchange="this.form.submit()">
                            <option value="">All Models</option>
                            @foreach($models as $key => $model)
                                <option value="{{ $key }}" {{ request('model') === $key ? 'selected' : '' }}>
                                    {{ $model['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="row mt-3">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Model</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($favorites as $favorite)
                        <tr>
                            <td>{{ class_basename($favorite->favoritable_type) }}</td>
                            <td>{{ $favorite->favoritable->name ?? $favorite->favoritable->position }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
