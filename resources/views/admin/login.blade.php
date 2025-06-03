<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ isset($title) ? $title . ' | ' . config('app.name') : config('app.name') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @livewireStyles

</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
  <div>
    <div class="h-screen bg-gray-100 text-gray-900 flex justify-center items-center">
      <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
        <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
          <div>
            <img src="{{ asset('frontend/assets/img/logo.png') }}" class="w-32 mx-auto" />
          </div>
          <div class="mt-12 flex flex-col items-center">
            <h1 class="text-2xl xl:text-3xl font-extrabold">
              Login
            </h1>

            <div class="w-full flex-1 mt-8">
              <div class="mx-auto max-w-xs">

                @if ($errors->any())
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
                @endif

                @if (session('success'))
                  {{ session('success') }}
                @endif

                @if (session('error'))
                  {{ session('error') }}
                @endif

                <form action="{{ route('admin_login_submit') }}" method="POST" class="space-y-6">
                  @csrf

                  <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email"
                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                      required>
                  </div>

                  <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password"
                      class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                      required>
                  </div>

                  <div class="flex items-center justify-between">
                    <button type="submit"
                      class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">
                      Login
                    </button>

                    <a href="{{ route('admin_forget_password') }}" class="text-sm text-blue-600 hover:underline">
                      Forget Password?
                    </a>
                  </div>
                </form>


              </div>
            </div>
          </div>
        </div>
        <div class="flex-1 bg-white text-center hidden lg:flex rounded-lg">
          <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
            style="background-image: url('{{ asset('frontend/assets/img/20945385.jpg') }}');">
          </div>
        </div>
      </div>
    </div>

  </div>

</body>

</html>
