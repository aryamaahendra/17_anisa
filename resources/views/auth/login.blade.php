<!DOCTYPE html>
<html data-theme="" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=roboto:300,300i,400,700,900" rel="stylesheet" />

    @vite(['resources/css/app.css'])
</head>

<body class="antialiased bg-base-300 min-h-screen min-w-screen grid place-content-center">
    <div class="card w-96 bg-base-100 shadow-xl">
        <form action="{{ route('login') }}" class="card-body" method="POST">
            @csrf
            @method('POST')

            <h2 class="card-title">Welcome :)</h2>
            <p>Login to see admin dashboard</p>

            <div class="mt-6">
                <div class="form-control w-full mb-4">
                    <div class="join">
                        <div
                            class="grid place-content-center rounded-none rounded-s border-gray-300 border px-2 bg-base-200">
                            <x-icons.mail />
                        </div>
                        <input type="email" name="email"
                            class="input input-bordered w-full join-item" placeholder="Email"
                            value="{{ old('email') }}" />
                    </div>

                    @error('email')
                        <label class="label ">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <div class="form-control w-full mb-1">
                    <div class="join">
                        <div
                            class="grid place-content-center rounded-none rounded-s border-gray-300 border px-2 bg-base-200">
                            <x-icons.lock />
                        </div>
                        <input type="password" name="password"
                            class="input input-bordered w-full join-item" placeholder="Password"
                            value="{{ old('password') }}" />
                    </div>
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-3">
                        <input type="checkbox" checked="checked" class="checkbox checkbox-sm" />
                        <span class="label-text">Remember me</span>
                    </label>
                </div>
            </div>

            <div class="card-actions justify-end mt-4">
                <button class="btn btn-primary btn-block">Login</button>
            </div>
        </form>
    </div>

    @vite(['resources/js/app.js'])
</body>

</html>
