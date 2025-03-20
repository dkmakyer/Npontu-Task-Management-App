@extends('layout.base')
@section('pageTitle')
    <title>All Tasks</title>
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
        <x-header :pageName="'All Tasks'" />

        <!-- Notification Pop-up -->
        <x-notification-component :id="auth()->user()->id" />

        <div class="flex h-screen pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()" />

            <!-- Main Content -->
            <div class="w-[70%]">
                <!-- Filter -->
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

                @if (!session('result'))
                    <div class="flex-1 p-6 flex space-x-6  absolute left-[19rem] top-[10rem]">
                        <!-- All Tasks List Except Completed -->
                        <div class="w-1/2 bg-white p-4 rounded shadow">
                            <div class="flex justify-start space-x-2 items-center mb-4">
                                <i class="fa-solid fa-layer-group text-[20px]"></i>
                                <h2 class="text-[13px]">All Tasks</h2>
                            </div>
                            <div class="mb-4 p-4 border border-[4px] border-gray-200 rounded flex items-start">
                                <div>
                                    @if (session('filtered'))
                                        @if (session('filtered')->count())
                                            @foreach (session('filtered') as $filtered)
                                                <div class="mb-4 p-4 pb-0 rounded flex items-start">

                                                    <div class="w-[100%]">
                                                        <h3 class="text-lg font-semibold">{{ $filtered->title }}</h3>
                                                        <p class="text-sm text-gray-600">{{ $filtered->description }}
                                                        </p>
                                                        <div
                                                            class="flex justify-between items-center text-sm text-gray-500 mt-4">
                                                            <span class="mr-4">Priority: <span
                                                                    class="text-red-500">{{ $filtered->priority }}</span></span>
                                                            <span>Category: <span
                                                                    class="text-red-500">{{ "  $filtered->category" }}</span></span>
                                                            <span class="ml-auto">Due on:
                                                                {{ $filtered->due_date->toFormattedDateString() }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex justify-center items-center mb-4">
                                                <h2 class="text-[13px] flex flex-row items-center gap-4">
                                                    <span class="text-red-400 text-[20px]">You have no tasks in the system
                                                        under
                                                        this category
                                                    </span>
                                                </h2>
                                            </div>
                                        @endif
                                    @else
                                        @if ($tasks->count())
                                            @foreach ($tasks as $task)
                                                <div class="mb-4 p-4 pb-0 rounded flex items-start">

                                                    <div class="w-[100%]">
                                                        <h3 class="text-lg font-semibold">{{ $task->title }}</h3>
                                                        <p class="text-sm text-gray-600">{{ $task->description }}
                                                        </p>
                                                        <div
                                                            class="flex justify-between items-center text-sm text-gray-500 mt-4">
                                                            <span class="mr-4">Priority: <span
                                                                    class="text-red-500">{{ $task->priority }}</span></span>
                                                            <span>Category: <span
                                                                    class="text-red-500">{{ "  $task->category" }}</span></span>
                                                            <span class="ml-auto">Due on:
                                                                {{ $task->due_date->toFormattedDateString() }}</span>
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        @else
                                            <div class="flex justify-center items-center mb-4">
                                                <h2 class="text-[13px] flex flex-row items-center gap-4"><i
                                                        class="fa-solid fa-clipboard-check text-[24px]"></i><span
                                                        class="text-red-400 text-[20px]">You
                                                        have no tasks in the system to be completed </span></h2>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="w-1/2 bg-white p-4 rounded shadow">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-[13px] flex flex-row gap-4"><i
                                        class="fa-solid fa-circle-check text-[20px]"></i><span
                                        class="text-red-400">Completed
                                        Tasks</span></h2>
                            </div>
                            <div class="task health mb-4 p-4 border border-[4px] border-gray-200 rounded flex items-start">
                                @if (session('filteredCompletedTasks'))
                                    @if (session('filteredCompletedTasks')->count())
                                        @foreach (session('filteredCompletedTasks') as $completedTask)
                                            <div class="mb-4 p-4 pb-0 rounded flex items-start">

                                                <div class="w-[100%]">
                                                    <h3 class="text-lg font-semibold">{{ $completedTask->title }}</h3>
                                                    <p class="text-sm text-gray-600">{{ $completedTask->description }}
                                                    </p>
                                                    <div
                                                        class="flex justify-between items-center text-sm text-gray-500 mt-4">
                                                        <span class="mr-4">Priority: <span
                                                                class="text-red-500">{{ $completedTask->priority }}</span></span>
                                                        <span>Category: <span
                                                                class="text-red-500">{{ "  $completedTask->category" }}</span></span>
                                                        <span class="ml-auto">Completed on:
                                                            {{ $completedTask->date_completed->toFormattedDateString() }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex justify-center items-center mb-4">
                                            <h2 class="text-[13px] flex flex-row items-center gap-4">
                                                <span class="text-red-400 text-[20px]">You have no completed tasks under
                                                    this
                                                    category in the
                                                    system
                                                </span>
                                            </h2>
                                        </div>
                                    @endif
                                @else
                                    @if ($completedTasks->count())
                                        @foreach ($completedTasks as $completedTask)
                                            <div class="mb-4 p-4 pb-0 rounded flex items-start">

                                                <div class="w-[100%]">
                                                    <h3 class="text-lg font-semibold">{{ $completedTask->title }}</h3>
                                                    <p class="text-sm text-gray-600">{{ $completedTask->description }}
                                                    </p>
                                                    <div
                                                        class="flex justify-between items-center text-sm text-gray-500 mt-4">
                                                        <span class="mr-4">Priority: <span
                                                                class="text-red-500">{{ $completedTask->priority }}</span></span>
                                                        <span>Category: <span
                                                                class="text-red-500">{{ "  $completedTask->category" }}</span></span>
                                                        <span class="ml-auto">Completed on:
                                                            {{ $completedTask->date_completed->toFormattedDateString() }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex justify-center items-center mb-4">
                                            <h2 class="text-[13px] flex flex-row items-center gap-4">
                                                <span class="text-red-400 text-[20px]">You
                                                    have not completed any tasks yet. Try to complete some for the list
                                                    to
                                                    be
                                                    updated
                                                </span>
                                            </h2>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex-1 p-6 flex space-x-6 absolute left-[19rem] top-[10rem]">
                        <!-- Search Results -->
                        <div class="bg-white p-4 rounded shadow">
                            <div class="flex justify-start space-x-2 items-center mb-4">
                                <i class="fa-solid fa-magnifying-glass text-[20px]"></i>
                                <h2 class="text-[13px]">Search Results</h2>
                            </div>
                            <div class="mb-4 p-4 border border-[4px] border-gray-200 rounded flex items-start">
                                <div>

                                    @if (session('result')->count())
                                        @foreach (session('result') as $result)
                                            <div class="mb-4 p-4 pb-0 rounded flex items-start">

                                                <div class="w-[100%]">
                                                    <h3 class="text-lg font-semibold">{{ $result->title }}</h3>
                                                    <p class="text-sm text-gray-600">{{ $result->description }}
                                                    </p>
                                                    <div
                                                        class="flex justify-between items-center text-sm text-gray-500 mt-4">
                                                        <span class="mr-4">Priority: <span
                                                                class="text-red-500">{{ $result->priority }}</span></span>
                                                        <span>Category: <span
                                                                class="text-red-500">{{ "  $result->category" }}</span></span>
                                                        <span class="ml-auto">Due on:
                                                            {{ $result->due_date->toFormattedDateString() }}</span>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex justify-center items-center mb-4">
                                            <h2 class="text-[13px] flex flex-row items-center gap-4">
                                                <span class="text-red-400 text-[20px]">No record found
                                                </span>
                                            </h2>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <script src="{{ asset('assets/js/task.js') }}"></script>
        <script>
            function redirect() {
                const dropdown = document.getElementById('selectFilter');
                const url = dropdown.value;

                if (url) {
                    window.location.href = url; // Redirect to the selected link
                }
            }
        </script>
    </body>
@endsection
