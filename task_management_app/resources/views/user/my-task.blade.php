@extends('layout.base')
@section('pageTitle')
    <title>My Task</title>
@endsection

@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
@endsection

@section('body')

    <body class="bg-gray-100 font-sans">
        <!-- Header -->
        <x-header :pageName="'My Tasks'"></x-header>
        <!-- Notification Pop-up -->
        <x-notifications-popup></x-notifications-popup>
        <div class="flex h-screen pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()"></x-sidebar>

            <!-- Main Content -->

            <div class="flex-1 flex flex-col ml-72">
                <!-- Content -->
                <div class="flex-1 p-6 flex space-x-6">
                    <!-- Task List -->
                    <div class="w-1/2 bg-white p-4 rounded shadow">
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
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold">My Tasks</h2>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded" onclick="openAddTaskModal()">
                                + Add Task
                            </button>
                        </div>
                        @if ($tasks->count())
                            @foreach ($tasks as $task)
                                <div id="task-list" class="space-y-4">
                                    <div class="p-4 border rounded-lg flex items-center justify-between" data-task-id="1">
                                        <div>
                                            <h3
                                                class="text-lg font-bold {{ $task->priority == 'high' ? ' text-red-500' : 'text-blue-500' }}">
                                                {{ $task->title }}</h3>
                                            <p class="text-gray-500">
                                                {{ substr($task->description, 0, strlen($task->description) - 10) }}...</p>
                                            <div class="text-sm text-gray-400">Priority: {{ " $task->priority" }} | Status:
                                                <span class="task-status">{{ $task->status }}</span>
                                            </div>
                                        </div>
                                        {{-- <img alt="Document submission illustration" class="rounded-lg" height="50"
                                            src="{{ $task->getImgUrl() }}" width="50" /> --}}
                                        <div class="flex mt-2">
                                            <a href="{{ route('update.task', $task->id) }}">
                                                <button class="bg-red-500 text-white px-4 py-2 rounded mr-2 edit-task">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('delete.task', $task->id) }}">
                                                <button class="bg-red-500 text-white px-4 py-2 rounded delete-task">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h2 class="text-xl font-semibold">You currently have no tasks that need to be completed</h2>
                        @endif


                    </div>

                    <!-- Task Details -->
                    @if (session('selectedTask'))
                        <div class="w-1/2 bg-white p-4 rounded shadow">
                            <h2 class="text-xl font-semibold mb-4">{{ session('selectedTask')->title }}</h2>
                            <img alt="Document image" class="w-24 h-24 rounded mb-4" height="100"
                                src="{{ session('selectedTask')->getImgUrl() }}" width="100" />
                            <p><strong>Task Title:</strong> {{ session('selectedTask')->title }}</p>
                            <p><strong>Task Description:</strong> {{ session('selectedTask')->description }}
                                {{-- <p><strong>Additional Notes:</strong></p>
                            <ul class="list-disc list-inside">
                                <li>Ensure that the documents are authentic and up-to-date.</li>
                                <li>Maintain confidentiality and security of sensitive information during the submission
                                    process.</li>
                                <li>If there are specific guidelines or deadlines for submission, adhere to them
                                    diligently.
                                </li>
                            </ul> --}}
                            <p><strong>Deadline for
                                    Submission:</strong>{{ '  ' . session('selectedTask')->due_date->toFormattedDateString() }}
                            </p>
                            <div class="flex space-x-4 mt-4">
                                <a href="{{ route('update.task', session('selectedTask')->id) }}"><button
                                        class="bg-red-500 text-white p-2 rounded">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </a>
                                <a href="{{ route('delete.task', session('selectedTask')->id) }}"><button
                                        class="bg-red-500 text-white p-2 rounded">
                                        <i class="fas fa-trash"></i>
                                    </button></a>
                            </div>
                        </div>
                    @else
                        @if ($tasks->count())
                            <div class="w-1/2 bg-white p-4 rounded shadow">
                                <h2 class="text-xl font-semibold mb-4">{{ $tasks[0]->title }}</h2>
                                <img alt="Document image" class="w-24 h-24 rounded mb-4" height="100"
                                    src="{{ $tasks[0]->getImgUrl() }}" width="100" />
                                <p><strong>Task Title:</strong> {{ $tasks[0]->title }}</p>
                                <p><strong>Task Description:</strong> {{ $tasks[0]->description }}
                                    {{-- <p><strong>Additional Notes:</strong></p>
                                <ul class="list-disc list-inside">
                                    <li>Ensure that the documents are authentic and up-to-date.</li>
                                    <li>Maintain confidentiality and security of sensitive information during the
                                        submission
                                        process.</li>
                                    <li>If there are specific guidelines or deadlines for submission, adhere to them
                                        diligently.
                                    </li>
                                </ul> --}}
                                <p><strong>Deadline for
                                        Submission:</strong>{{ '  ' . $tasks[0]->due_date->toFormattedDateString() }}
                                </p>
                                <div class="flex space-x-4 mt-4">
                                    <a href="{{ route('update.task', $tasks[0]->id) }}"><button
                                            class="bg-red-500 text-white p-2 rounded">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('delete.task', $tasks[0]->id) }}"><button
                                            class="bg-red-500 text-white p-2 rounded">
                                            <i class="fas fa-trash"></i>
                                        </button></a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Add Task Modal -->
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
                            <input class="w-full p-2 border rounded" id="task-title" type="text" placeholder="Task Title"
                                required name="title" />
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

        <script src="{{ asset('assets/js/task.js') }}"></script>
    </body>
@endsection
