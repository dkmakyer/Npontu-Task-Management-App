@extends('layout.base')
@section('pageTitle')
    <title>Recently Completed Tasks</title>
@endsection
@section('stylesheet')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endsection
@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('body')

    <body class="bg-gray-100 font-sans">
        <!-- Header -->
        <x-header :pageName="'Completed Tasks'"></x-header>
        <!-- Notification Pop-up -->
        <x-notifications-popup></x-notifications-popup>
        <div class="flex h-screen pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()"></x-sidebar>

            <!-- Main Content -->
            <div class="w-[70%]">
                <!-- Content -->
                <div class="flex flex-row gap-[2px] absolute top-[7rem] right-[2rem] items-center">
                    <i class="fa-solid fa-filter"></i>

                    <select id="selectFilter" class="border p-1 rounded " name="filter" onchange="redirect()">

                        <option value="" selected disabled>Filter</option>
                        <option value="{{ route('filtered.tasks', 'educational') }}">Educational
                        </option>
                        <option value="{{ route('filtered.tasks', 'health') }}">Health and Fitness
                        </option>
                        <option value="{{ route('filtered.tasks', 'all') }}">All</option>
                    </select>


                </div>

                <div
                    class="flex-1 p-6 flex space-x-6 border border-[2px] border-gray-200 absolute left-[24rem] top-[10rem] w-[60%]">
                    <!-- Recently Completed Tasks List -->
                    <div class="bg-white p-4 rounded shadow w-[100%]">
                        @if (session('filtered'))
                            @if (session('filtered')->count())
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-[13px] flex flex-row gap-4"><i
                                            class="fa-solid fa-clipboard-check text-[20px]"></i><span
                                            class="text-red-400">Completed
                                            Task</span></h2>
                                </div>
                                @foreach (session('filtered') as $filtered)
                                    <div class="mb-4 p-4 border border-[4px] border-green-500 rounded flex items-start"
                                        data-url="../View/View.html">
                                        <i class="fas fa-circle text-red-500 mr-4 mt-1"></i>
                                        <div class="w-[100%]">
                                            <h3 class="text-lg font-semibold">{{ $filtered->title }}</h3>
                                            <p class="text-sm text-gray-600">{{ $filtered->description }}
                                            </p>
                                            <div class="flex items-center text-sm text-gray-500 mt-2">
                                                <span class="mr-4">Priority: <span
                                                        class="text-red-500">{{ $filtered->priority }}</span></span>
                                                <span>Category: <span
                                                        class="text-red-500">{{ $filtered->category }}</span></span>
                                                <span class="ml-auto">Completed on:
                                                    {{ $filtered->date_completed->toFormattedDateString() }}</span>
                                            </div>
                                        </div>
                                        {{-- <img alt="Document image" class="w-20 h-20 rounded ml-4" height="50"
                                        src="./logo.jpg" /> --}}
                                    </div>
                                @endforeach
                            @else
                                <div class="flex justify-center items-center mb-4">
                                    <h2 class="text-[13px] flex flex-row items-center gap-4"><i
                                            class="fa-solid fa-clipboard-check text-[24px]"></i><span
                                            class="text-red-400 text-[20px]">You
                                            have not completed any tasks yet. Try and complete some for the list to be
                                            updated</span></h2>
                                </div>
                            @endif
                        @else
                            @if ($tasks->count())
                                <div class="flex justify-between items-center mb-4">
                                    <h2 class="text-[13px] flex flex-row gap-4"><i
                                            class="fa-solid fa-clipboard-check text-[20px]"></i><span
                                            class="text-red-400">Completed
                                            Task</span></h2>
                                </div>
                                @foreach ($tasks as $task)
                                    <div class="mb-4 p-4 border border-[4px] border-green-500 rounded flex items-start"
                                        data-url="../View/View.html">
                                        <i class="fas fa-circle text-red-500 mr-4 mt-1"></i>
                                        <div class="w-[100%]">
                                            <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                                            <p class="text-sm text-gray-600">{{ $task->description }}
                                            </p>
                                            <div class="flex justify-between items-center text-sm text-gray-500 mt-2">
                                                <span class="mr-4">Priority: <span
                                                        class="text-red-500">{{ $task->priority }}</span></span>
                                                <span>Category: <span
                                                        class="text-red-500">{{ "  $task->category" }}</span></span>
                                                <span class="ml-auto">Completed on:
                                                    {{ $task->date_completed->toFormattedDateString() }}</span>
                                            </div>
                                        </div>
                                        {{-- <img alt="Document image" class="w-20 h-20 rounded ml-4" height="50"
                                            src="./logo.jpg" /> --}}
                                    </div>
                                @endforeach
                            @else
                                <div class="flex justify-center items-center mb-4">
                                    <h2 class="text-[13px] flex flex-row items-center gap-4"><i
                                            class="fa-solid fa-clipboard-check text-[24px]"></i><span
                                            class="text-red-400 text-[20px]">You
                                            have not completed any tasks yet. Try and complete some for the list to be
                                            updated</span></h2>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/task.js') }}"></script>
    </body>

    <script>
        function redirect() {
            const dropdown = document.getElementById('selectFilter');
            const url = dropdown.value;

            if (url) {
                window.location.href = url; // Redirect to the selected link
            }
        }
    </script>
@endsection
