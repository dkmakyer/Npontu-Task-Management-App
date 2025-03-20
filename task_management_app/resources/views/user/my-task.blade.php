@extends('layout.base')

@section('pageTitle')
    <title>My Task</title>
@endsection

@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        .modal {
            display: none;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .modal.show {
            display: flex;
        }
    </style>
@endsection

@section('body')

    {{-- <body class="bg-gray-100">
        <!-- Header -->
        <x-header :pageName="'My Tasks'"></x-header>

        <!-- Notification Pop-up -->
        <x-notification-component :id="auth()->user()->id"></x-notification-component>

        <div class="flex h-screen pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()"></x-sidebar>


            <!-- Main Content -->
            <div class="flex-1 p-6 ml-72">
                <!-- This section is for the search results -->
                @session('result')
                    @foreach (session('result') as $result)
                        <div>
                            <h6 class="">Search results</h6>
                            <h3 class="text-lg font-semibold">{{ $result->title }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ substr($result->description, 0, strlen($result->description) - 5) }}...</p>
                            <div class="flex items-center text-sm text-gray-500 mt-2">
                                <span class="mr-4">Priority: <span
                                        class="text-red-500">{{ "  $result->priority" }}</span></span>
                                <span>Status: <span class="text-red-500">{{ "  $result->status   " }}</span></span>
                                <span class="ml-auto ps-4">Created on:
                                    {{ '  ' . $result->created_at->toFormattedDateString() }}</span>
                            </div>
                        </div>
                    @endforeach
                @endsession
                <!-- Search results section has ended-->

                <!-- Add Task and Invite Buttons -->
                <div class="flex flex-row items-center justify-between mb-4">
                    <button class="bg-red-200 text-black px-4 py-2 rounded" onclick="openAddTaskModal()">
                        + Add Task
                    </button>
                    <button id="mainInviteButton" class="bg-red-200 text-black px-4 py-2 rounded-md"
                        onclick="openCollaboration()">
                        <i class="fas fa-user-plus mr-2"></i>Invite
                    </button>
                </div>

                <!-- Task Status -->
                <div class="space-y-6">
                    <div
                        class="bg-white p-6 rounded-lg shadow hover:shadow-lg transform hover:-translate-y-2 transition-all duration-300 cursor-pointer w-[49%]">
                        <h3 class="text-xl font-semibold mb-4">Task Status</h3>
                        <div class="flex justify-between items-center mb-4">
                            <div class="text-center">
                                <div class="relative">
                                    <div
                                        class="w-16 h-16 rounded-full border-4 border-green-500 flex items-center justify-center">
                                        <span id="completedPercentage"
                                            class="text-lg font-semibold">{{ "$completed%" }}</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Completed</p>
                            </div>
                            <div class="text-center">
                                <div class="relative">
                                    <div
                                        class="w-16 h-16 rounded-full border-4 border-yellow-500 flex items-center justify-center">
                                        <span id="inProgressPercentage"
                                            class="text-lg font-semibold">{{ "$uncompleted%" }}</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">In Progress</p>
                            </div>
                            <div class="text-center">
                                <div class="relative">
                                    <div
                                        class="w-16 h-16 rounded-full border-4 border-red-500 flex items-center justify-center">
                                        <span id="notStartedPercentage" class="text-lg font-semibold">0%</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Not Started</p>
                            </div>
                        </div>
                    </div>

                    <!-- To-Do List -->
                    <div class="flex flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6">
                        <div class="bg-white p-6 rounded-lg shadow-md w-full md:w-1/2">
                            <h2 class="text-xl font-bold mb-4">To-Do</h2>
                            <div id="task-list" class="space-y-4">
                                @if ($tasks->count())
                                    @foreach ($tasks as $task)
                                        <div id="task-list" class="space-y-4">
                                            <div class="p-4 border rounded-lg flex justify-between">
                                                <div>
                                                    <h3
                                                        class="text-lg font-bold {{ $task->priority == 'high' ? ' text-red-500' : 'text-green-500' }}">
                                                        @can('edit', $task)
                                                            <input type="checkbox" name="completed" class="mr-3"
                                                                class="checked" onchange="changed(this)"
                                                                data-url="{{ route('task.completed', $task->id) }}">
                                                        @endcan
                                                        <a
                                                            href="{{ route('show.task.details', $task->id) }}">{{ $task->title }}</a>
                                                    </h3>
                                                    <p class="text-gray-500">
                                                        {{ substr($task->description, 0, strlen($task->description) - 10) }}...
                                                    </p>
                                                    <div class="text-sm text-gray-400">Priority: {{ " $task->priority" }}
                                                        |
                                                        Status:
                                                        <span class="task-status">Uncompleted</span>
                                                    </div>
                                                </div>
                                                @can('edit', $task)
                                                    <div class="flex justify-between items-start">

                                                        <a href="{{ route('update.task', $task->id) }}">
                                                            <button class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('delete.task', $task->id) }}">
                                                            <button class="bg-red-500 text-white px-4 py-2 rounded">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </a>

                                                    </div>
                                                @endcan
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h2 class="text-xl font-semibold">You currently have no tasks that need to be completed
                                    </h2>
                                @endif
                            </div>
                        </div>
                        <!-- Task Details -->
                        @if (session('selectedTask'))
                            <div class="w-1/2 bg-white p-4 rounded shadow">
                                <h2 class="text-xl font-semibold mb-4">{{ session('selectedTask')->title }}</h2>
                                <img alt="Document image" class="w-24 h-24 rounded mb-4" height="100"
                                    src="{{ session('selectedTask')->getImgUrl() }}" width="100" />
                                <p><strong>Task Title:</strong> {{ session('selectedTask')->title }}</p>
                                <p><strong>Task Description:</strong> {{ session('selectedTask')->description }}

                                <p><strong>Deadline for
                                        Submission:</strong>{{ '  ' . session('selectedTask')->due_date->toFormattedDateString() }}
                                </p>
                                @can('edit', session('selectedTask'))
                                    <div class="flex items-start">

                                        <a href="{{ route('update.task', session('selectedTask')->id) }}">
                                            <button class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('delete.task', session('selectedTask')->id) }}">
                                            <button class="bg-red-500 text-white px-4 py-2 rounded">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </a>

                                    </div>
                                @endcan
                            </div>
                        @else
                            @if ($tasks->count())
                                <div class="w-1/2 bg-white p-4 rounded shadow">
                                    <h2 class="text-xl font-semibold mb-4">{{ $tasks[0]->title }}</h2>
                                    <img alt="Document image" class="w-24 h-24 rounded mb-4" height="100"
                                        src="{{ $tasks[0]->getImgUrl() }}" width="100" />
                                    <p><strong>Task Title:</strong> {{ $tasks[0]->title }}</p>
                                    <p><strong>Task Description:</strong> {{ $tasks[0]->description }}

                                    <p><strong>Deadline for
                                            Submission:</strong>{{ '  ' . $tasks[0]->due_date->toFormattedDateString() }}
                                    </p>
                                    @can('edit', $tasks[0])
                                        <div class="flex items-start">

                                            <a href="{{ route('update.task', $tasks[0]->id) }}">
                                                <button class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('delete.task', $tasks[0]->id) }}">
                                                <button class="bg-red-500 text-white px-4 py-2 rounded">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </a>

                                        </div>
                                    @endcan
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- Add task modal -->
        <div class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-30" id="addTaskModal"
            onclick="closeAddTaskModal(event)">
            <div class="bg-white p-6 rounded shadow-lg w-1/2 max-h-[90vh] overflow-y-auto relative"
                onclick="event.stopPropagation()">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-xl font-semibold">Add New Task</h2>
                        <div class="w-24 h-1 bg-red-500 mt-1"></div>
                    </div>
                    <button class="text-red-500" onclick="closeAddTaskModal()">Go Back</button>
                </div>
                <form class="flex flex-col justify-between h-full" action="{{ route('store.task', auth()->user()->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="task-title">Title</label>
                            <input class="w-full p-2 border rounded" id="task-title" type="text"
                                placeholder="Task Title" required name="title" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="task-category">Category</label>
                            <select class="w-full p-2 border rounded" id="task-category" required name="category">
                                <option value="">Select Category</option>
                                <option value="Educational">Educational</option>
                                <option value="Health and Fitness">Health and Fitness</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="task-date">Date</label>
                            <input class="w-full p-2 border rounded" id="task-date" type="date" required
                                name="date" />
                        </div>
                        <div class="mb-4">
                            <span class="block text-gray-700">Priority</span>
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input class="mr-2" name="priority" type="radio" value="low" required />
                                    <span class="text-red-500">Low</span>
                                </label>
                                <label class="flex items-center">
                                    <input class="mr-2" name="priority" type="radio" value="medium" required />
                                    <span class="text-blue-500">Medium</span>
                                </label>
                                <label class="flex items-center">
                                    <input class="mr-2" name="priority" type="radio" value="high" required />
                                    <span class="text-green-500">High</span>
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700" for="task-description">Task Description</label>
                                <textarea class="w-full p-2 border rounded h-32" id="task-description" placeholder="Start writing here..." required
                                    name="description"></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700">Upload Image</label>
                                <div class="border-dashed border-2 border-gray-300 rounded p-4 text-center">
                                    <i class="fas fa-image text-gray-400 text-4xl mb-2"></i>
                                    <p>Drag & Drop files here or</p>
                                    <input type="file" class="hidden" id="task-image" name='image' />
                                    <button type="button" class="bg-gray-200 text-black px-4 py-2 rounded mt-2"
                                        onclick="document.getElementById('task-image').click()">Browse</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-start">
                        <button
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transform hover:scale-105 transition-transform duration-200"
                            type="submit">
                            Done
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- add collaboration modal -->
        <div class="collaboration fixed inset-0 bg-gray-800 bg-opacity-50 items-center justify-center top-20 hidden"
            id="addCollaboration">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg translate-x-[7rem] z-50">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">
                        Send an invite to a new member
                    </h1>
                    <button id="collaboBackButton" class="text-gray-600 fw-bold" href="#">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="border-b-2 border-red-500 mb-6"></div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="email">
                        Email
                    </label>
                    <div class="flex">
                        <form action="{{ route('send.invite') }}" method="post">
                            @csrf
                            <input class="flex-1 p-2 border border-gray-300 rounded-l-md" id="email" type="email"
                                placeholder="email" name="email" />
                            <button class="bg-red-500 text-white px-4 py-2 rounded-r-md" type="submit">
                                Send Invite
                            </button>

                        </form>
                    </div>
                </div>
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4">
                        Members
                    </h2>
                    @if ($collaborators)
                        @foreach ($collaborators as $collaborator)
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <img alt="{{ 'Profile picture of ' . $collaborator->user->username }}"
                                        class="w-10 h-10 rounded-full mr-4" height="40"
                                        src="https://storage.googleapis.com/a1aa/image/k2rIxYXOp9TMFQB3GFLqFYLEQzwdgzTKy5jUVTeDZAc.jpg"
                                        width="40" />
                                    <div>
                                        <p class="font-semibold">{{ $collaborator->user->username }}</p>
                                        <p class="text-gray-600">{{ $collaborator->user->email }}</p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>

        <script>
            function changed(element) {
                if (element.checked) {
                    const url = element.dataset.url;
                    window.location.href = url;
                }
            }
        </script>
        <script src="{{ asset('assets/js/task.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body> --}}

    <body class="bg-gray-100">
        <!-- Header -->
        <x-header :pageName="'My Tasks'" />

        <!-- Notification Popup-->
        <x-notification-component :id="auth()->user()->id" />

        <!-- Collaboration Pop-up -->
        <x-collaboration-notification-component />

        <div class="flex h-screen pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()" />

            <!-- Main content -->
            <div class="flex-1 p-6 ml-72">

                <!-- Add Task Button -->
                <div class="flex flex-row items-center justify-between mb-4">

                    <button class="bg-red-500 text-white px-4 py-2 rounded-md" onclick="openAddTaskModal()">
                        + Add Task
                    </button>
                    <button id="mainInviteButton" class="bg-red-500 text-white px-4 py-2 rounded-md"
                        onclick="openCollaboration()">
                        <i class="fas fa-user-plus mr-2"></i>Invite
                    </button>

                </div>

                <!-- Tasks Properties -->
                <div class="flex space-x-6">
                    <div class="space-y-6 flex flex-col space-y-4 w-[100%]">
                        <div class="bg-transparent rounded-lg w-[100%] flex justify-between ">
                            <!-- Task Status -->
                            <div
                                class="flex justify-center space-x-[2rem] items-center w-[100%] bg-white p-6 rounded-lg hover:shadow-lg transform hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-500 mb-2">Completed</p>
                                    <div class="relative">
                                        <div
                                            class="w-32 h-32 rounded-full border-8 border-green-300 flex items-center justify-center">
                                            <span id="completedPercentage"
                                                class="text-[2rem] font-semibold text-green-500">{{ "$completed%" }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-500 mb-2">In progress</p>
                                    <div class="relative">
                                        <div
                                            class="w-32 h-32 rounded-full border-8 border-gray-400 flex items-center justify-center">
                                            <span id="completedPercentage"
                                                class="text-[2rem] font-semibold text-gray-400">{{ "$inProgress%" }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-400 mb-2">Uncompleted</p>
                                    <div class="relative">
                                        <div
                                            class="w-32 h-32 rounded-full border-8 border-red-300 flex items-center justify-center">
                                            <span id="completedPercentage"
                                                class="text-[2rem] font-semibold text-red-300">{{ "$uncompleted%" }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <p class="text-xl font-bold text-gray-400 mb-2">Tasks Total </p>
                                    <div class="relative">
                                        <div
                                            class="w-32 h-32 rounded-full border-8 border-blue-300 flex items-center justify-center">
                                            <span id="completedPercentage"
                                                class="text-[2rem] font-semibold text-blue-300">{{ $tasks->count() }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- All Tasks -->
                        @if ($ownerTasks->count())
                            <div class="flex h-[30rem] flex-col md:flex-row space-y-6 md:space-y-0 md:space-x-6 w-[100%]">
                                <div class="flex flex-row gap-2">
                                    <!-- User Tasks -->
                                    <div class="bg-white p-6 rounded-lg shadow-md w-full h-[110%] md:w-1/2 overflow-y-auto">
                                        <h2 class="text-xl font-bold mb-4">To-Do</h2>
                                        <div id="task-list" class="space-y-4">
                                            @if ($tasks->count())
                                                @foreach ($tasks as $task)
                                                    <div id="task-list" class="space-y-4">
                                                        <div
                                                            class="p-4 border rounded-lg flex justify-between items-baseline">
                                                            <div>
                                                                <h3
                                                                    class="text-lg font-bold {{ $task->priority == 'high' ? ' text-red-500' : 'text-green-500' }}">
                                                                    @can('edit', $task)
                                                                        <input type="checkbox" name="completed" class="mr-3"
                                                                            class="checked" onchange="changed(this)"
                                                                            data-url="{{ route('task.completed', $task->id) }}">
                                                                    @endcan
                                                                    <a
                                                                        href="{{ route('show.task.details', $task->id) }}">{{ $task->title }}</a>
                                                                </h3>
                                                                <p class="text-gray-500">
                                                                    {{ substr($task->description, 0, strlen($task->description) - 10) }}...
                                                                </p>
                                                                <div class="text-sm text-gray-400 mt-2">Priority:
                                                                    {{ " $task->priority" }}
                                                                    |
                                                                    Status:
                                                                    <span class="task-status">In progress</span>
                                                                </div>
                                                                @can('edit', $task)
                                                                    <div class="flex justify-end">

                                                                        <a href="{{ route('update.task', $task->id) }}">
                                                                            <button
                                                                                class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                                                                                <i class="fas fa-edit"></i>
                                                                            </button>
                                                                        </a>
                                                                        <a href="{{ route('delete.task', $task->id) }}">
                                                                            <button
                                                                                class="bg-red-500 text-white px-4 py-2 rounded">
                                                                                <i class="fas fa-trash"></i>
                                                                            </button>
                                                                        </a>

                                                                    </div>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <h2 class="text-xl font-semibold">You currently have no tasks that are
                                                    in progress
                                                </h2>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Collaborated Tasks -->
                                    <div
                                        class="bg-white p-6 rounded-lg shadow-md h-[110%] w-100% md:w-1/2 overflow-y-auto space-y-6">
                                        <h2 class="text-xl font-bold mb-4">Collaboration Tasks</h2>
                                        @foreach ($ownerTasks as $ownerTask)
                                            <div id="task-list" class="space-y-4">
                                                <div
                                                    class="dynamicTask p-4 border rounded-lg flex justify-between items-baseline">
                                                    <div>
                                                        {{-- <p class="w-4 h-4 rounded-full bg-red-500"></p> --}}
                                                        <h3 class="text-lg font-bold text-red-500">{{ $ownerTask->title }}
                                                        </h3>
                                                        <p class="text-gray-500">
                                                            {{ substr($ownerTask->description, 0, strlen($ownerTask->description) - 10) . '...' }}
                                                        </p>
                                                        <div class="text-sm text-gray-400 mt-2">
                                                            Priority:{{ "  $ownerTask->priority  " }} | Status: <span
                                                                class="task-status"> In progress</span></div>
                                                        <div class="flex mt-2 flex-col gap-4 items-end">
                                                            <div class="flex flex-row">
                                                                <a
                                                                    href="{{ route('leave.collaboration', $ownerTask->user->id) }}">
                                                                    <button
                                                                        class="bg-red-500 text-white px-4 py-2 rounded mr-2 exit-task">
                                                                        <i class="fas fa-door-open"></i>
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- User Tasks -->
                            <div class="bg-white p-6 rounded-lg shadow-md w-full h-[110%] overflow-y-auto">
                                <h2 class="text-xl font-bold mb-4">To-Do</h2>
                                <div id="task-list" class="space-y-4">
                                    @if ($tasks->count())
                                        @foreach ($tasks as $task)
                                            <div id="task-list" class="space-y-4">
                                                <div class="p-4 border rounded-lg flex justify-between items-baseline">
                                                    <div>
                                                        <h3
                                                            class="text-lg font-bold {{ $task->priority == 'high' ? ' text-red-500' : 'text-green-500' }}">
                                                            @can('edit', $task)
                                                                <input type="checkbox" name="completed" class="mr-3"
                                                                    class="checked" onchange="changed(this)"
                                                                    data-url="{{ route('task.completed', $task->id) }}">
                                                            @endcan
                                                            <a
                                                                href="{{ route('show.task.details', $task->id) }}">{{ $task->title }}</a>
                                                        </h3>
                                                        <p class="text-gray-500">
                                                            {{ substr($task->description, 0, strlen($task->description) - 10) }}...
                                                        </p>
                                                        <div class="text-sm text-gray-400 mt-2">Priority:
                                                            {{ " $task->priority" }}
                                                            |
                                                            Status:
                                                            <span class="task-status">In progress</span>
                                                        </div>
                                                        @can('edit', $task)
                                                            <div class="flex justify-end">

                                                                <a href="{{ route('update.task', $task->id) }}">
                                                                    <button
                                                                        class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </a>
                                                                <a href="{{ route('delete.task', $task->id) }}">
                                                                    <button class="bg-red-500 text-white px-4 py-2 rounded">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </a>

                                                            </div>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h2 class="text-xl font-semibold">You currently have no tasks that are
                                            in progress
                                        </h2>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Task details -->
                    <div
                        class="task-details overflow-y-auto bg-white h-[47.5rem] p-6 rounded-lg shadow-lg w-[45%] space-y-[3rem]">
                        @if (session('selectedTask'))
                            <div class="flex items-center space-x-4 mb-4">
                                <img alt="Document submission illustration" class="rounded-lg" height="100"
                                    src="{{ session('selectedTask')->getImgUrl() }}" width="100" />
                                <div>
                                    <h2 class="text-xl font-bold">{{ session('selectedTask')->user->username }}</h2>
                                    <div class="flex flex-col text-sm text-gray-400">
                                        <p>Priority: {{ ' ' . session('selectedTask')->priority }}</p>
                                        <p>Status: {{ 'In progress' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold">Task Title:</h3>
                                <p>{{ ' ' . session('selectedTask')->title }}</p>
                            </div>
                            <div>
                                <h3 class="font-bold">Objective:</h3>
                                <p>{{ substr(session('selectedTask')->description, 0, 15) }}</p>
                            </div>
                            <div>
                                <h3 class="font-bold">Task Description:</h3>
                                <p>{{ session('selectedTask')->description . '.' }}</p>
                            </div>
                            <div>
                                <h3 class="font-bold">Deadline for Completion:</h3>
                                <p>{{ session('selectedTask')->due_date->toFormattedDateString() }}</p>
                            </div>
                            @can('edit', session('selectedTask'))
                                <div class="flex items-start">

                                    <a href="{{ route('update.task', session('selectedTask')->id) }}">
                                        <button class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('delete.task', session('selectedTask')->id) }}">
                                        <button class="bg-red-500 text-white px-4 py-2 rounded">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>

                                </div>
                            @endcan
                        @else
                            @if ($tasks->count())
                                <div class="flex items-center space-x-4 mb-4">
                                    <img alt="Document submission illustration" class="rounded-lg" height="100"
                                        src="{{ $tasks[0]->getImgUrl() }}" width="100" />
                                    <div>
                                        <h2 class="text-xl font-bold">{{ $tasks[0]->user->username }}</h2>
                                        <div class="flex flex-col text-sm text-gray-400">
                                            <span>Priority: {{ ' ' . $tasks[0]->priority }}</span>
                                            <span>Status: In progress</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-bold">Task Title:</h3>
                                    <p>{{ '  ' . $tasks[0]->title }}</p>
                                </div>

                                <div>
                                    <h3 class="font-bold">Task Description:</h3>
                                    <p>{{ $tasks[0]->description . '.' }}</p>
                                </div>
                                <div>
                                    <h3 class="font-bold">Deadline for Completion:</h3>
                                    <p>{{ $tasks[0]->due_date->toFormattedDateString() }}</p>
                                </div>
                                @can('edit', $tasks[0])
                                    <div class="flex items-start">

                                        <a href="{{ route('update.task', $tasks[0]->id) }}">
                                            <button class="bg-red-500 text-white px-4 py-2 rounded mr-2">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('delete.task', $tasks[0]->id) }}">
                                            <button class="bg-red-500 text-white px-4 py-2 rounded">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </a>

                                    </div>
                                @endcan
                            @endif
                        @endif
                    </div>

                </div>
            </div>
        </div>


        <!-- Add task modal -->
        <div class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-30"
            id="addTaskModal" onclick="closeAddTaskModal(event)">
            <div class="bg-white p-6 rounded shadow-lg w-1/2 max-h-[80vh] overflow-y-auto relative"
                onclick="event.stopPropagation()">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-xl font-semibold">Add New Task</h2>
                        <div class="w-24 h-1 bg-red-500 mt-1"></div>
                    </div>
                    <button class="text-red-500" onclick="closeAddTaskModal()"><i class="fa fa-times"></i></button>
                </div>
                <form class="flex flex-col justify-around h-[70%]" action="{{ route('store.task', auth()->user()->id) }}"
                    method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="task-title">Title</label>
                            <input class="w-full p-2 border rounded" id="task-title" type="text"
                                placeholder="Task Title" required name="title" />
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="task-category">Category</label>
                            <select class="w-full p-2 border rounded" id="task-category" required name="category">
                                <option value="">Select Category</option>
                                <option value="Educational">Educational</option>
                                <option value="Health and Fitness">Health and Fitness</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700" for="task-date">Date</label>
                            <input class="w-full p-2 border rounded" id="task-date" type="date" required
                                name="date" />
                        </div>
                        <div class="mb-4">
                            <span class="block text-gray-700">Priority</span>
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input class="mr-2" name="priority" type="radio" value="low" required />
                                    <span class="text-red-500">Low</span>
                                </label>
                                <label class="flex items-center">
                                    <input class="mr-2" name="priority" type="radio" value="medium" required />
                                    <span class="text-blue-500">Medium</span>
                                </label>
                                <label class="flex items-center">
                                    <input class="mr-2" name="priority" type="radio" value="high" required />
                                    <span class="text-green-500">High</span>
                                </label>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 ">
                            <div>
                                <label class="block text-gray-700" for="task-description">Task Description</label>
                                <textarea class="w-full p-2 border rounded h-[10rem]" id="task-description" placeholder="Start writing here..."
                                    required name="description"></textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700">Upload Image</label>
                                <div class="border-dashed border-2 border-gray-300 rounded p-4 text-center">
                                    <i class="fas fa-image text-gray-400 text-4xl mb-2"></i>
                                    <p>Drag & Drop files here or</p>
                                    <input type="file" class="hidden" id="task-image" name='image' />
                                    <button type="button" class="bg-gray-200 text-black px-4 py-2 rounded mt-2"
                                        onclick="document.getElementById('task-image').click()">Browse</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-start">
                        <button
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transform hover:scale-105 transition-transform duration-200"
                            type="submit">
                            Done
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add collaboration modal -->
        <div class="collaboration fixed inset-0 bg-gray-800 bg-opacity-50 items-center justify-center top-20 hidden"
            id="addCollaboration">
            <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-lg translate-x-[7rem] z-50">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-semibold">
                        Send an invite to a new member
                    </h1>
                    <button id="collaboBackButton" class="text-gray-600 fw-bold" href="#">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="border-b-2 border-red-500 mb-6"></div>
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2" for="email">
                        Email
                    </label>
                    <div class="flex">
                        <form action="{{ route('send.invite') }}" method="post">
                            @csrf
                            <input class="flex-1 p-2 border border-gray-300 rounded-l-md" id="email" type="email"
                                placeholder="username" name="email" />
                            <button class="bg-red-500 text-white px-4 py-2 rounded-r-md" type="submit">
                                Send Invite
                            </button>

                        </form>
                    </div>
                </div>
                <div class="mb-6">
                    <h2 class="text-lg font-semibold mb-4">
                        Members
                    </h2>
                    @if ($collaborators)
                        @foreach ($collaborators as $collaborator)
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <img alt="{{ 'Profile picture of ' . $collaborator->user->username }}"
                                        class="w-10 h-10 rounded-full mr-4" height="40"
                                        src="{{ $collaborator->user->getImgUrl() }}" width="40" />
                                    <div>
                                        <p class="font-semibold">{{ $collaborator->user->username }}</p>
                                        <p class="text-gray-600">{{ $collaborator->user->email }}</p>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>

        <script>
            function changed(element) {
                if (element.checked) {
                    const url = element.dataset.url;
                    window.location.href = url;
                }
            }
        </script>
        <script src="{{ asset('assets/js/task.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    </body>
@endsection
