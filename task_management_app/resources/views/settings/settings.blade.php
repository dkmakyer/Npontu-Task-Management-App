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
            <div class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-20"
                id="notificationPopup">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md relative">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold">Notifications</h2>
                        <button class="text-gray-500 hover:text-gray-700" id="closePopup">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Juice Slider" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/t0n560aaRmjPTxTzIw1sTLi0mcmTR9T18TaeGowluao.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the entire design for
                                    <span class="font-semibold">Juice Slider</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Pet Warden" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/nbXuoql5zJtaLlZye-1e7pT0L7H47lqcUrr9oFkmElk.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the entire design for
                                    <span class="font-semibold">Pet Warden</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">Extremely High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Mobile app design" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/lfz-gc2qOiibF5x3rCRjcrTvoajKPaxF96OY2WSx9FM.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the <span class="font-semibold">Mobile app design</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Travel Days" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/DRM2UekJL7f-qDedAHqCg0o4Zc_nU3Br8x6Tm4PTGd0.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the UI design of Landing Page for
                                    <span class="font-semibold">Travel Days</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of FoodVentures" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/6zeIM8h32RPi0c0ul6mB7VF971N5iVlC5egWgC6xKfM.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the UI design of Landing Page for
                                    <span class="font-semibold">FoodVentures</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Notification Pop-up -->
            <div class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-20"
                id="notificationPopup">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md relative">
                    <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-xl font-semibold">Notifications</h2>
                        <button class="text-gray-500 hover:text-gray-700" id="closePopup">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Juice Slider" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/t0n560aaRmjPTxTzIw1sTLi0mcmTR9T18TaeGowluao.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the entire design for
                                    <span class="font-semibold">Juice Slider</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Pet Warden" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/nbXuoql5zJtaLlZye-1e7pT0L7H47lqcUrr9oFkmElk.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the entire design for
                                    <span class="font-semibold">Pet Warden</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">Extremely High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Mobile app design" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/lfz-gc2qOiibF5x3rCRjcrTvoajKPaxF96OY2WSx9FM.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the <span class="font-semibold">Mobile app design</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Travel Days" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/DRM2UekJL7f-qDedAHqCg0o4Zc_nU3Br8x6Tm4PTGd0.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the UI design of Landing Page for
                                    <span class="font-semibold">Travel Days</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of FoodVentures" class="w-12 h-12 rounded" height="50"
                                    src="https://storage.googleapis.com/a1aa/image/6zeIM8h32RPi0c0ul6mB7VF971N5iVlC5egWgC6xKfM.jpg"
                                    width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    Complete the UI design of Landing Page for
                                    <span class="font-semibold">FoodVentures</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">High</span>
                                </p>
                                <p class="text-gray-400">2h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <a href="../Theme/theme.html" class="block">
                                    <button class="w-full text-left bg-gray-200 p-2 text-sm rounded">Theme</button>
                                </a>
                                <a href="../Advanced/advanced.html" class="block">
                                    <button class="w-full text-left bg-gray-200 p-2 text-sm rounded">Advanced
                                        options</button>
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
