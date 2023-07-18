@extends('admin.layouts.base')

@section('contents')
    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <th scope="row" class="text-center">{{ $type->id }}</th>
                    <td class="text-center">{{ $type->name }}</td>
                    <td class="text-center">
                        <a class="btn btn-primary m-1"
                            href="{{ route('admin.types.show', ['type' => $type->id]) }}">View</a>
                        <a class="btn btn-warning m-1"
                            href="{{ route('admin.types.edit', ['type' => $type->id]) }}">Edit</a>
                        <form class="d-inline-block" method="POST"
                            action="{{ route('admin.types.destroy', ['type' => $type->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
