@extends('admin.layouts.base')

@section('contents')
    <section>

        @if (session('delete_success'))
            @php $tecnology = session('delete_success') @endphp
            <div class="alert alert-danger">
                The tecnology "{{ $tecnology->name }}" has been deleted
            </div>
        @endif

        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tecnologies as $tecnology)
                    <tr>
                        <th scope="row">{{ $tecnology->id }}</th>
                        <td>{{ $tecnology->name }}</td>
                        <td>
                            <a class="btn btn-primary m-1"
                                href="{{ route('admin.tecnologies.show', ['tecnology' => $tecnology->id]) }}">View</a>
                            <a class="btn btn-warning m-1"
                                href="{{ route('admin.tecnologies.edit', ['tecnology' => $tecnology->id]) }}">Edit</a>
                            <form class="d-inline-block" method="POST"
                                action="{{ route('admin.tecnologies.destroy', ['tecnology' => $tecnology->id]) }}">
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
