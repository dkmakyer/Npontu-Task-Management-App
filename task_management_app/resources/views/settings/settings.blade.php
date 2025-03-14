@extends('layout.base')
@section('pageTitle')
    <title>Settings Page</title>
@endsection
@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection
@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
@endsection

@section('body')

    <body class="bg-gray-100">
        <div class="flex min-h-screen">
            <!-- Header -->
            <x-header :pageName="'Settings'"></x-header>
            <!-- Notification Pop-up -->
            <x-notification-component :id="auth()->user()->id"></x-notification-component>
            <div class="flex h-screen pt-16">
                <!-- Sidebar -->
                <x-sidebar :user="auth()->user()"></x-sidebar>

                <!-- Main Content -->
                <div class="flex-1 p-6 ml-72">
                    <div class="flex">
                        <div class="w-1/2">
                            <div class="flex items-center mb-6">
                                <img alt="Profile picture of the user" class="rounded-full w-24 h-24" height="100"
                                    src="https://storage.googleapis.com/a1aa/image/NKqPE6qrEmDQ96jGKZeM8CHERalOCM9dq8ryW55U3aY.jpg"
                                    width="100" />
                                <div class="ml-4">
                                    <h2 class="text-xl font-semibold">{{ auth()->user()->first_name }}</h2>
                                    <p class="text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <a href="{{ route('profile') }}" class="block">
                                    <button class="w-full text-left bg-gray-200 p-2 text-sm rounded">Account Info</button>
                                </a>
                                <a href="{{ route('change.password') }}" class="block">
                                    <button class="w-full text-left bg-gray-200 p-2 text-sm rounded">Security
                                        Options</button>
                                </a>
                                <a href="../Notifications/notifications.html" class="block">
                                    <button class="w-full text-left bg-gray-200 p-2 text-sm rounded">Notifications</button>
                                </a>
                                <a href="{{ route('help') }}" class="block">
                                    <button class="w-full text-left bg-gray-200 p-2 text-sm rounded">Help</button>
                                </a>
                            </div>
                        </div>
                        <div class="w-1/2 pl-6">
                            <div class="bg-white p-6 rounded shadow">
                                <h2 class="text-xl font-semibold mb-4">Help</h2>
                                <p class="text-gray-700 mb-4">
                                    For more information, click on the link below to access details pertaining to this
                                    software
                                </p>
                                <a class="text-blue-500" href="https://www.mytask.com.gh">https://www.mytask.com.gh</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/js/settings.js') }}"></script>
    </body>
@endsection
