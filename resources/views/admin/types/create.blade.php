@extends('admin.layouts.base')

@section('contents')
    <section class="container-sm bg-body-secondary p-4 my-4 rounded col-6">
        <h1 class="p-3">Add Type</h1>

        <form method="POST" action="{{ route('admin.types.store') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name') }}">

                <div class="invalid-feedback">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="8"
                    name="description">{{ old('description') }}</textarea>
                <div class="invalid-feedback">
                    @error('description')
                        {{ $message }}
                    @enderror
                </div>
            </div>

            <button class="btn btn-primary">Crea</button>
        </form>
    </section>
@endsection
