@extends('layout.base')
@section('pageTitle')
    <title>Settings</title>
@endsection
@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
@endsection
@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection
@section('body')

    <body class="bg-gray-100 font-sans">
        <!-- Header -->
        <x-header :pageName="'Profile'"></x-header>

        <div class="flex h-screen pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()"></x-sidebar>

            <!-- Main Content -->
            <div class="flex-1 p-6 ml-72">
                <!-- Account Information -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex items-center mb-6">
                        <img alt="User profile picture" class="rounded-full w-12 h-12 mr-4" height="50"
                            src="https://placehold.co/50x50" width="50" />
                        <div>
                            <h3 class="text-lg font-semibold">{{ $user->first_name }}</h3>
                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <form method="Post">
                        <div class="grid grid-cols-1 gap-4 mb-4">
                            <input class="border rounded-lg px-4 py-2" placeholder="{{ $user->first_name }}"
                                type="text" />
                            <input class="border rounded-lg px-4 py-2" placeholder="{{ $user->last_name }}"
                                type="text" />
                            <input class="border rounded-lg px-4 py-2" placeholder="{{ $user->email }}" type="email" />

                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('update.profile') }}"><button
                                    class="bg-red-500 text-white px-4 py-2 rounded-lg" type="button">Update
                                    Info</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
@endsection
