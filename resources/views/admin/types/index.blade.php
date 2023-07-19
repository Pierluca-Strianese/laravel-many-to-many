@extends('admin.layouts.base')

@section('contents')
    <section>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>
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
    </section>
@endsection
