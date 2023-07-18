@php
    $user = Auth::user();
@endphp

<nav class="navbar navbar-expand-lg bg-body-tertiary mb-5">
    <div class="container-xxl">
        <a class="navbar-brand" href="{{ route('guests.home') }}">Boolfolio</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-flex" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Projects
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.project.index') }}">Index</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.project.create') }}">New Project</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.project.trashed') }}">Trash</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Type
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('admin.types.index') }}">Index</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.types.create') }}">New type</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="navbar-nav me-5 mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ $user->name }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Edit profile</a>
                        </li>

                        <li>
                            <form class="dropdown-item" action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-dark">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            {{-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
</nav>
