<!DOCTYPE html>
<html lang="en" class="h-full ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="h-full ">
    <!--
  This example requires some changes to your config:

  ```
  // tailwind.config.js
  module.exports = {
    // ...
    plugins: [
      // ...
      require('@tailwindcss/forms'),
    ],
  }
  ```
-->
<!--
  This example requires updating your template:

  ```
  <html class="h-full bg-gray-50">
  <body class="h-full">
  ```
-->
<div class="flex h-full flex-col justify-center py-12 sm:px-6 lg:px-8" style="background-image:url('/img/cycle-bg.png');">
    <div class=" sm:mx-auto sm:w-full sm:max-w-md p-8 align-middle border border-cyan-600" style="background: rgba(255, 255, 255, 0.164);
    backdrop-filter: blur(10px);box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; border-radius:20px;">
        @if(Session::has('fails'))
            <div class="mt-2" role="alert">
                <div class="text-sm font-bold bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-2 w-1/2">{{ Session::get('fails') }}</div>
                @php
                Session::forget('success');
                @endphp
            </div>
        @elseif(Session::has('success'))
            <div class="mt-2" role="alert">
                <div class="text-sm font-bold bg-green-100 border-l-4 border-green-500 text-green-700 p-2 w-1/2">{{ Session::get('success') }}</div>
                @php
                Session::forget('success');
                @endphp
            </div>
        @endif
        <div class="sm:mx-auto sm:w-full sm:max-w-md ">
            {{-- <img class="mx-auto h-12 w-auto" src="{{ asset('img/finallogo.png') }}" alt="Your Company"> --}}
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in to your account</h2>

        </div>

          <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md border-1">
            <div class=" py-8 px-4 sm:rounded-lg sm:px-10">
              <form class="space-y-6" action="{{ route('check') }}" method="POST">
                @csrf
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <div class="mt-1">
                    <input id="email" name="email" type="email" autocomplete="email" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" autofocus>
                  </div>
                </div>

                <div>
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <div class="mt-1">
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                  </div>
                </div>

                <div class="flex items-center justify-between">
                  <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                  </div>

                  <div class="text-sm">
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
                  </div>
                </div>

                <div>
                  <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-cyan-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">Sign in</button>
                </div>
              </form>
            </div>
          </div>
    </div>

  </div>

</body>
</html>
