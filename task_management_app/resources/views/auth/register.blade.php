@extends('layout.base')
@section('pageTitle')
    <title>
        Sign Up
    </title>
@endsection

@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
@endsection

@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('body')

    <body class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg flex max-w-4xl mx-auto">
            <div class="hidden md:block w-1/2 p-6">
                <img alt="Illustration of a person interacting with digital interfaces" class="w-full h-full object-cover"
                    height="600"
                    src="https://storage.googleapis.com/a1aa/image/ajuwPKyaveq15vsfCdsqLVi2xvog3gB2oMLN7xo4uQo.jpg"
                    width="400" />
            </div>
            <div class="w-full md:w-1/2 p-8">
                @session('error')
                    <p class="text-red-500 text-xl text-center">{{ session('error') }}</p>
                @endsession
                <h2 class="text-3xl font-bold mb-6">
                    Sign Up
                </h2>
                <form class="grid grid-cols-2 gap-4" action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="first-name">
                            <i class="fas fa-user">
                            </i>
                            Enter First Name
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="first-name" placeholder="Enter First Name" type="text" name="firstName"
                            value="{{ old('firstName') }}" />
                        @error('firstName')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="last-name">
                            <i class="fas fa-user">
                            </i>
                            Enter Last Name
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="last-name" placeholder="Enter Last Name" type="text" name="lastName"
                            value="{{ old('lastName') }}" />
                        @error('lastName')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            <i class="fas fa-user">
                            </i>
                            Enter Username
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="username" placeholder="Enter Username" type="text" name="username"
                            value="{{ old('username') }}" />
                        @error('username')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            <i class="fas fa-envelope">
                            </i>
                            Enter Email
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="email" placeholder="Enter Email" type="email" name="email"
                            value="{{ old('email') }}" />
                        @error('email')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            <i class="fas fa-lock">
                            </i>
                            Enter Password
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="password" placeholder="Enter Password" type="password" name="password" />
                        @error('password')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm-password">
                            <i class="fas fa-lock">
                            </i>
                            Confirm Password
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            id="confirm-password" placeholder="Confirm Password" type="password"
                            name="password_confirmation" />
                    </div>
                    <div class="mb-4 translate-x-[4rem] text-center flex flex-col items-center justify-between gap-8">
                        <label class="inline-flex items-center">
                            <input class="form-checkbox text-indigo-600" type="checkbox" name="terms" />
                            <span class="ml-2 text-gray-700">
                                I agree to all terms
                            </span>
                        </label>
                        @error('terms')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                        <div class=" flex flex-col items-center justify-between gap-4">
                            <button
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
                                type="submit">
                                Register
                            </button>
                            <p class="text-gray-700">
                                Already have an account?
                                <a class="text-blue-500" href="{{ route('login') }}">
                                    Sign In
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
@endsection
