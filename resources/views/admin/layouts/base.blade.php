<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/js/app.js')
</head>

<body>

    @include('admin.includes.header')

    <div class="container">
        <main>
            <section class="row justify-content-md-center">
                @yield ('contents')
            </section>
        </main>
    </div>

    @include('admin.includes.footer')

</body>

</html>
