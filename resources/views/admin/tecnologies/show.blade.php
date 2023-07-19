@extends('admin.layouts.base')

@section('contents')
    <section class="row">

        <h1 class=" col-4 text-primary border-bottom border-primary p-2"> {{ $type->name }} </h1>

    </section>

    <section class="row">

        <p class="p-3"> {{ $type->description }} </p>

    </section>

    <section class="row">

        <h2 class="fs-4 pb-2"> Project in {{ $type->name }}: </h2>

    </section>

    <section class="row">

        <ul class=" col-2 list-group list-group-flush">
            @foreach ($type->projects()->orderBy('created_at', 'DESC')->limit(3)->get() as $project)
                <li class="list-group-item"><a
                        href="{{ route('admin.project.show', ['project' => $project]) }}">{{ $project->title }}</a></li>
            @endforeach
        </ul>

    </section>
@endsection
