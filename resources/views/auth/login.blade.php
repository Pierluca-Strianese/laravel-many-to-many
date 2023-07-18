@extends('guests.layouts.base')

@section('contents')
    <section class="row justify-content-md-center mt-4">
        <form class="col-6 bg-body-secondary p-4 rounded-3" method="post" action="{{ route('login') }}">
            @csrf

            <h1 class="p-2">Accedi</h1>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required
                    autofocus autocomplete="username">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    autocomplete="current-password" value="{{ old('email') }}">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <div class="mt-3"><a href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            </div>
        </form>
    </section>
@endsection
