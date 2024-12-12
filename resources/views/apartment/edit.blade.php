@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Apartment</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('apartment.update', $apartment) }}">
                            @csrf
                            <input type="hidden" name="_method" value="patch" />

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $apartment->name }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="residents" class="col-md-4 col-form-label text-md-right">{{ __('Residents') }}</label>

                                <div class="col-md-6">
                                    <select id="residents" name="residents[]" multiple class="form-control @error('residents') is-invalid @enderror" name="residents">
                                        <option value="">Select Residents</option>
                                        @foreach($users as $id => $name)
                                            <option value="{{ $id }}" {!! in_array($id, $residents) ? 'selected' : '' !!}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                    @error('residents')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Task List</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div style="text-align:right !important;">
                                    <a href="{{ route('task.create', $apartment->id) }}" type="button" class="btn btn-success">Create Task</a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <th>Title</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @foreach($apartment->tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->datetime)->toFormattedDateString() }}</td>
                                    <td>{!! $task->formatted_status !!}</td>
                                    <td><a href="{{ route('task.edit', $task->id) }}">Edit</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
