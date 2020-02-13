<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- dropzone library --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="theme-light bg-page">
<div id="app">


        <nav class="bg-header section border-b flex px-6 py-2 items-center flex-none">
            <div class="container mx-auto">
                <div class="flex justify-between items-center py-2">


                    <a class="" href="{{ url('/') }}">
                        <img class="h-20 w-20" src="/images/logo3.svg" alt="Ikat">
                    </a>


                    <div>
                        <!-- Right Side Of Navbar -->
                        <div class="flex items-center ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <a class="text-accent mr-4 no-underline hover:underline" href="{{ route('login') }}">{{ __('Login') }}</a>

                                @if (Route::has('register'))
                                    <a class="text-accent no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <theme-switcher></theme-switcher>

                                <dropdown align="right">
                                    <template v-slot:trigger>
                                        <button
                                            class="flex items-center text-default no-underline text-sm focus:outline-none"
                                            v-pre
                                        >
                                            <img width="35"
                                                 class="rounded-full mr-3"
                                                 src="{{ gravatar_url(auth()->user()->email) }}">

                                            {{ auth()->user()->name }}
                                        </button>
                                    </template>

                                    <form id="logout-form" method="POST" action="/logout" class="mr-4">
                                        @csrf

                                        <button type="submit" class="dropdown-menu-link w-full text-left">Logout</button>
                                    </form>
                                </dropdown>



                            @endguest
                        </div>
                    </div>


                </div>
            </div>
        </nav>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>

        <div class="section px-6 py-4 flex-1 overflow-y-scroll">
            <main class=" container mx-auto py-4">
                @yield('content')
            </main>
        </div>



</div>
</body>
</html>
