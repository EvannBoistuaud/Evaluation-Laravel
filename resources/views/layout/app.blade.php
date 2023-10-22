<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <title>@yield('title', 'Reservation')</title>
</head>

<body>
    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
        @auth
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Log Out') }}
            </x-dropdown-link>
        </form>
        @else
            <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{__("Log in")}}</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{__("Register")}}</a>
            @endif
        @endauth
    </div>


    <div class="container">
        @auth
    <nav class="pb-5">
        @can('salle-index')
      <a style="background-color:#eae0c2; border-radius:28px; border:1px solid #333029; display:inline-block; cursor:pointer; color:#505739; font-family:Arial; font-size:17px; padding:10px 15px; text-decoration:none; text-shadow:0px 1px 0px #ffffff; :hover:background-color:#ccc2a6;" href="{{ route('salle.index') }}">{{__('Room List')}}</a>
      @endcan
      @can('client-index')
      <a style="background-color:#eae0c2; border-radius:28px; border:1px solid #333029; display:inline-block; cursor:pointer; color:#505739; font-family:Arial; font-size:17px; padding:10px 15px; text-decoration:none; text-shadow:0px 1px 0px #ffffff;" href="{{ route('client.index') }}">{{__('Customer Area')}}</a>
      @endcan
      @can('reserv-index')
      <a style="background-color:#eae0c2; border-radius:28px; border:1px solid #333029; display:inline-block; cursor:pointer; color:#505739; font-family:Arial; font-size:17px; padding:10px 15px; text-decoration:none; text-shadow:0px 1px 0px #ffffff;" href="{{ route('reserv.index') }}">{{__('Your Reservations')}}</a>
      @endcan
      <a style="background-color:#eae0c2; border-radius:28px; border:1px solid #333029; display:inline-block; cursor:pointer; color:#505739; font-family:Arial; font-size:17px; padding:10px 15px; text-decoration:none; text-shadow:0px 1px 0px #ffffff;" href="/">{{__("Main Menu")}}</a>
        @csrf


    </form>
    <div>
        {{ __('Vous naviguez en') }} [{{ session('locale') }}] [{{ App::getLocale() }}]
        <a href="{{ route('language.change', ['code_iso' => 'fr']) }}">{{ __('French') }}</a>
        <a href="{{ route('language.change', ['code_iso' => 'en']) }}">{{ __('English') }}</a>
      </div>
    </nav>

    @endauth
    @yield('content')
  </div>
</body>

</html>
