@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <img class="img-thumbnail rounded-circle" width="200" src="https://haieng.com/wp-content/uploads/2017/10/test-image-500x500.jpg" alt="test img">
            <h5 class="card-title">{{ $contact->full_name }}</h5>


            <span class="fs-6 text-secondary-emphasis">
                {{ $contact->position }} @ <a href="{{ route('companies.show', ['company' => $contact->company->id]) }}">{{ $contact->company->name }}</a>
            </span>

            <hr class="hr" />

            <div class="row">
                <div class="col-12">
                    <table>
                        <tr>
                            <td>
                                <span><i class="bi bi-telephone"></i> Phone</span>
                            </td>
                            <td>{{ $contact->phone }}</td>
                        </tr>

                        <tr>
                            <td>
                                <span><i class="bi bi-envelope"></i> Email</span>
                            </td>
                            <td>{{ $contact->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
