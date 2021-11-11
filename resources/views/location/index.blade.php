@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($location as $index => $data)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    <form method="POST" action="{{ route('location.destroy', ['id'=> $data->id]) }}">
                                        @csrf @method('DELETE')
                                        <a class="btn btn-sm btn-primary" href="{{ route('location.show', ['id' => $data->id]) }}">Show</a> |
                                        <a class="btn btn-sm btn-secondary" href="{{ route('location.edit', ['id' => $data->id]) }}">Edit</a> |
                                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
