@extends('admin.layouts.base')

@section('contents')
    <section>

        <h1 class="text-primary pb-4 ps-3"> {{ $project->title }} </h1>
        <section class="ps-3 border-top border-bottom border-primary col-4">

            <h2 class="fs-4 pt-3"> Type: <button type="button" class="btn btn-light"><a class="text-decoration-none"
                        href="{{ route('admin.types.show', ['type' => $project->type]) }}">{{ $project->type->name }}
                    </a></button>
            </h2>

            <h2 class="fs-5">Author: <span class="text-success"> {{ $project->author }} </span> </h2>
            <h3 class="fs-6">Collaborators: <span class="text-success"> {{ $project->collaborators }} </span></h3>
            <h3 class=" fs-6 pb-3"> Languages: <span class="text-primary">
                    {{ $project->languages }} </span> </h3>

        </section>

    </section>

    <section>

        <p class="p-3"> {{ $project->description }} </p>

    </section>

    <section>

        <p class="border-top pt-3"> Date creation: {{ $project->creation_date }} </p>
        <p> Last Update: {{ $project->last_update }} </p>

    </section>
@endsection
