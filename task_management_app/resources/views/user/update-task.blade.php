@extends('layout.base')
@section('pageTitle')
    <title>Update Task</title>
@endsection
@section('script')
    <script src="https://cdn.tailwindcss.com"></script>
@endsection

@section('stylesheet')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
@endsection

@section('body')

    <body class="bg-gray-100">
        <div class="flex flex-col h-screen">
            <!-- Header -->
            <x-header :pageName="'Update Task'"></x-header>
            <!-- Notification Pop-up -->
            <x-notification-component :id="auth()->user()->id"></x-notification-component>
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()"></x-sidebar>
            <!-- Main Content -->
            <div class="flex-1 p-6 ml-72 ">
                <div class="bg-white p-8 rounded shadow-lg max-w-3xl mx-auto mt-16">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold">
                            Update Task
                        </h2>
                    </div>
                    <form class="flex flex-col justify-between h-full" action="{{ route('update.task', $id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700" for="task-title">Title</label>
                                <input class="w-full p-2 border rounded" id="task-title" type="text"
                                    placeholder="Task Title" name="title" />
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700" for="task-category">Category</label>
                                <select class="w-full p-2 border rounded" id="task-category" name="category">
                                    <option value="">Select Category</option>
                                    <option value="Educational">Educational</option>
                                    <option value="Health and Fitness">Health and Fitness</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700" for="task-date">Date</label>
                                <input class="w-full p-2 border rounded" id="task-date" type="date" name="date" />
                            </div>
                            <div class="mb-4">
                                <span class="block text-gray-700">Priority</span>
                                <div class="flex items-center space-x-4">
                                    <label class="flex items-center">
                                        <input class="mr-2" name="priority" type="radio" value="low" />
                                        <span class="text-red-500">Low</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input class="mr-2" name="priority" type="radio" value="medium" />
                                        <span class="text-blue-500">Medium</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input class="mr-2" name="priority" type="radio" value="high" />
                                        <span class="text-green-500">High</span>
                                    </label>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-gray-700" for="task-description">Task Description</label>
                                    <textarea class="w-full p-2 border rounded h-32" id="task-description" placeholder="Start writing here..."
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
        </div>

        <script src="{{ asset('assets/js/task.js') }}"></script>
    </body>
@endsection
