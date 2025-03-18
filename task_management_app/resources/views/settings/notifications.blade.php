@extends('layout.base')

@section('pageTitle')
    <title>Notification Setting</title>
@endsection

@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        .toggle-switch {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 20px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(20px);
        }
    </style>
@endsection

@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection


@section('body')

    <body class="bg-gray-100 overflow-x-hidden">
        <div class="flex min-h-screen">
            <!-- Header -->
            <x-header :pageName="'Notification Settings'"></x-header>
            <!-- Notification Pop-up -->
            <x-notification-component :id="auth()->user()->id"></x-notification-component>

            <div class="flex h-screen pt-16">
                <!-- Sidebar -->
                <x-sidebar :user="auth()->user()" />

                <!-- Main Content -->
                <div class="p-6 ml-72 translate-x-[2rem]">

                    <div class="flex">
                        <div class="w-full">
                            <div class="flex flex-col items-center mb-6">
                                <img alt="Profile picture of the user" class="rounded-full w-24 h-24" height="100"
                                    src="https://storage.googleapis.com/a1aa/image/NKqPE6qrEmDQ96jGKZeM8CHERalOCM9dq8ryW55U3aY.jpg"
                                    width="100" />
                                <div class="ml-4 flex flex-col items-center">
                                    <h2 class="text-xl font-semibold">{{ auth()->user()->username }}</h2>
                                    <p class="text-gray-500">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span>Enable or disable</span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="toggleEnable">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span>Notification type</span>
                                    <button class="bg-gray-200 p-2 text-sm rounded">Change</button>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span>Notification sound</span>
                                    <label class="toggle-switch">
                                        <input type="checkbox" id="toggleSound">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <audio id="notificationSound" src="https://www.soundjay.com/button/beep-07.wav" preload="auto"></audio>
        <script src="{{ asset('assets/js/notifications.js') }}"></script>
        <script>
            function toggleNotification(container) {
                const span = container.querySelector('.notif-span');
                const ball = container.querySelector('.notif-ball');

                // Toggle active class for span
                span.classList.toggle('active');

                // Get the current transform value of the ball
                const currentTransform = getComputedStyle(ball).transform;
                const translateX = currentTransform === 'none' ? 0 : parseFloat(currentTransform.split(',')[4]);

                // Check if the ball is in its original position (14rem)
                if (translateX === 224) { // 14rem = 224px
                    // Move the ball 1 rem to the left (13rem = 208px)
                    ball.style.transform = `translateX(-16px) translateY(-2.3rem)`; // Move left by 1 rem
                } else {
                    // Return the ball to its original position (14rem = 224px)
                    ball.style.transform = `translateX(0) translateY(-2.3rem)`; // Return to original position
                }
            }
        </script>
    </body>
@endsection
