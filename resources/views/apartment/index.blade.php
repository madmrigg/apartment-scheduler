@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Apartment List
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align:right !important;">
                                    <a href="{{ route('apartment.create') }}" type="button" class="btn btn-success">Create </a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach($apartments as $apartment)
                                <tr>
                                    <td width="90%">{{ $apartment->name }}</td>
                                    <td><a href="{{ route('apartment.edit', $apartment) }}">Edit</a> </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
