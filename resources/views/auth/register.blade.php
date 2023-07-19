@extends('guests.layouts.base')

@section('contents')
    <section class="row justify-content-md-center mt-4">
        <form class="col-6 bg-body-secondary p-4 rounded-3" method="post" action="{{ route('register') }}">
            @csrf

            <h1 class="text-primary">Create Account</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Name & Surname</label>
                <input type="text" class="form-control" id="name" name="name" required autofocus
                    autocomplete="name" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus
                    autocomplete="username" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    autocomplete="new-password">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Confirm password</label>
                <input type="password" class="form-control" id="password" name="password_confirmation" required
                    autocomplete="new-password">
            </div>

            <div class="d-grid gap-2 pt-3">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>

            <div class="pt-3 text-center">

                <a href="{{ route('login') }}">
                    Already registered?
                </a>

            </div>
        </form>
    </section>
@endsection
