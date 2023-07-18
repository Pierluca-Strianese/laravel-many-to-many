@extends('admin.layouts.base')

@section('contents')
    <div class="container row justify-content-md-center">
        <section class=" col-8">

            <h1>{{ $user->name }} <p class="fs-6">(User account)</p>
            </h1>
            <div class="mt-5">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div>
                @include('profile.partials.update-password-form')
            </div>
            <div class="mt-5 mb-5">
                @include('profile.partials.delete-user-form')
            </div>
        </section>
    </div>
@endsection
