<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>@yield('title', 'Formation Laravel 10')</title>
</head>

<body>
  <div class="container">
    <nav class="pb-5">
      <a href="{{ route('salle.index') }}">Listes des salles</a>
      <a href="{{ route('client.index') }}">Listes des clients</a>
      <a href="{{ route('reserv.index') }}">Listes des reservations</a>
      <form method="POST" action="{{ route('logout') }}">
        @csrf


    </form>
    </nav>
    @yield('content')
  </div>
</body>

</html>