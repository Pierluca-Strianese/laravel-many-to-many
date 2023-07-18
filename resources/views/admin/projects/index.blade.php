@extends('admin.layouts.base')

@section('contents')
    @if (session('delete_success'))
        @php $project = session('delete_success') @endphp
        <div class="alert alert-danger">
            The project "{{ $project->title }}" has been Deleted
            <form action="{{ route('admin.project.cancel', ['project' => $project]) }}" method="post" class="d-inline-block">
                @csrf
                <button class="btn btn-warning">Cancel</button>
            </form>
        </div>
    @endif

    <table class="table align-middle">
        <thead>
            <tr>
                <th scope="col" class="text-center">Title</th>
                <th scope="col" class="text-center">Type</th>
                <th scope="col" class="text-center">Author</th>
                <th scope="col" class="text-center">Last Update</th>
                <th scope="col" class="text-center">Description</th>
                <th scope="col" class="text-center">Languages</th>
                <th scope="col" class="text-center">Link Github</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->title }}</th>
                    <td><button type="button" class="btn btn-light"><a class="text-decoration-none"
                                href="{{ route('admin.types.show', ['type' => $project->type]) }}">{{ $project->type->name }}</a></button>
                    </td>
                    <td>{{ $project->author }}</td>
                    <td class="font-monospace">{{ $project->last_update }}</td>
                    <td>{{ $project->description }}</td>
                    <td class="font-monospace">{{ $project->languages }}</td>
                    <td class="text-center"> <a href="{{ $project->link_github }}"> LINK </a></td>
                    <td class="text-center">
                        <a class="btn btn-primary m-1"
                            href="{{ route('admin.project.show', ['project' => $project->id]) }}">View</a>
                        <a class="btn btn-warning m-1"
                            href="{{ route('admin.project.edit', ['project' => $project->id]) }}">Edit</a>
                        <form class="d-inline-block" method="POST"
                            action="{{ route('admin.project.destroy', ['project' => $project->id]) }}">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end p-2">
        <button class="btn btn-outline-danger"><a class="dropdown-item"
                href="{{ route('admin.project.trashed') }}">Trash</a></button>
    </div>
@endsection
