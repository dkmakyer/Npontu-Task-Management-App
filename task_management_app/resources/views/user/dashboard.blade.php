<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&family=Inter:wght@400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="flex justify-between items-center shadow-md bg-gray-50 mb-8 fixed w-full p-4 z-10">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold text-red-500">
                Dash<span class="text-black">board</span>
            </h1>
        </div>
        <div class="flex items-center">
            <div class="bg-red-400 p-2 rounded h-[2rem] flex items-center justify-center mr-4 cursor-pointer"
                id="notificationButton">
                <i class="fas fa-bell text-white text-xl"></i>
            </div>
            <a href="../Settings/Settings.html">
                <div class="bg-red-400 p-2 rounded h-[2rem] flex items-center justify-center mr-4">
                    <i class="fas fa-cog text-white text-xl"></i>
                </div>
            </a>
            <p class="text-black flex flex-col items-center">
                {{ date('l') }}<span class="text-[12px] text-blue-400">{{ date('d/m/Y') }}</span>
            </p>
        </div>
    </header>
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
    </div>
    <div class="flex h-screen pt-16">
        <div class="flex h-screen pt-16">
            <!-- Sidebar -->
            <x-sidebar :user="auth()->user()"></x-sidebar>

            <!-- Main Content -->
            <div class="flex-1 p-6 ml-72">
                <main>
                    <h2 class="text-3xl font-semibold mb-6">
                        Welcome back, {{ auth()->user()->first_name }}
                        <span class="wave">👋</span>
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- To Do Section -->
                        <div class="col-span-2">
                            <div class="bg-white p-6 rounded-lg shadow">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-xl font-semibold">To Do</h3>
                                    <button class="text-red-500" onclick="openModal()">
                                        <i class="fas fa-plus"></i>
                                        Add Task
                                    </button>
                                </div>

                                @if ($tasks->count())
                                    <div class="space-y-4">
                                        @foreach ($tasks as $task)
                                            <div class="p-4 bg-gray-50 rounded-lg shadow">
                                                <div class="flex justify-between items-center mb-2">
                                                    <h4 class="text-lg font-semibold">{{ $task->title }}</h4>
                                                    <span
                                                        class="text-sm text-gray-500">{{ $task->due_date->toFormattedDateString() }}</span>
                                                </div>
                                                <p class="text-gray-600 mb-2">
                                                    {{ $task->description }}
                                                </p>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-blue-500">Priority:
                                                        {{ $task->priority }}</span>
                                                    <span class="text-sm text-green-500">Status:
                                                        {{ $task->status }}</span>
                                                    <span class="text-sm text-gray-500">Created on:
                                                        {{ $task->created_at->toFormattedDateString() }}</span>
                                                </div>
                                                <img alt="{{ $task->title }}" class="mt-2 rounded-lg"
                                                    height="100" src="{{ $task->getImgUrl() }}" width="100" />
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                            </div>
                        </div>
                        <!-- Task Status and Completed Task Section -->
                        <div class="space-y-6">
                            <div
                                class="bg-white p-6 rounded-lg shadow hover:shadow-lg transform hover:-translate-y-2 transition-all duration-300 cursor-pointer">
                                <h3 class="text-xl font-semibold mb-4">Task Status</h3>
                                <div class="flex justify-between items-center mb-4">
                                    <div class="text-center">
                                        <div class="relative">
                                            <div
                                                class="w-16 h-16 rounded-full border-4 border-green-500 flex items-center justify-center">
                                                <span id="completedPercentage" class="text-lg font-semibold">0%</span>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-2">Completed</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="relative">
                                            <div
                                                class="w-16 h-16 rounded-full border-4 border-yellow-500 flex items-center justify-center">
                                                <span id="inProgressPercentage"
                                                    class="text-lg font-semibold">0%</span>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-2">In Progress</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="relative">
                                            <div
                                                class="w-16 h-16 rounded-full border-4 border-red-500 flex items-center justify-center">
                                                <span id="notStartedPercentage"
                                                    class="text-lg font-semibold">0%</span>
                                            </div>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-2">Not Started</p>
                                    </div>
                                </div>
                            </div>

                            @if ($completedTasks->count())
                                <div class="bg-white p-6 rounded-lg shadow">
                                    <h3 class="text-xl font-semibold mb-4">Completed
                                        {{ Str::plural('Task', $completedTasks->count()) }}</h3>
                                    <div class="space-y-4">
                                        @foreach ($completedTasks as $completedTask)
                                            <div class="p-4 bg-gray-50 rounded-lg shadow">
                                                <div class="flex justify-between items-center mb-2">
                                                    <h4 class="text-lg font-semibold">{{ $completedTask->title }}</h4>
                                                    <span
                                                        class="text-sm text-gray-500">{{ $completedTask->due_date->toFormattedDateString() }}</span>
                                                </div>
                                                <p class="text-gray-600 mb-2">
                                                    {{ $completedTask->description }}
                                                </p>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-sm text-blue-500">Priority:
                                                        {{ $completedTask->priority }}</span>
                                                    <span class="text-sm text-gray-500">Created on:
                                                        {{ $completedTask->created_at->toFormattedDateString() }}</span>
                                                </div>
                                                <img alt="{{ $completedTask->title }}" class="mt-2 rounded-lg"
                                                    height="100" src="{{ $completedTask->getImgUrl() }}"
                                                    width="100" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
            </main>
        </div>
    </div>

    <!-- Add Task Modal -->
    <div class="modal" id="addTaskModal">
        <div class="modal-content">
            <div class="header flex justify-between items-center mb-4">
                <div class="title-container">
                    <h1 class="text-xl font-semibold">Add New Task</h1>
                    <div class="underline w-24 h-1 bg-red-500 mt-1"></div>
                </div>
                <span class="close-modal" onclick="closeModal()">Go Back</span>
            </div>

            <form class="content-container space-y-4" method="POST"
                action="{{ route('tasks.store', auth()->user()->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="block font-semibold mb-1">Title</label>
                    <input type="text" class="input-field w-full border rounded p-2" name="title" required>
                </div>

                <div class="form-group">
                    <label class="block font-semibold mb-1">Date</label>
                    <div class="relative">
                        <input type="date" class="input-field w-full border rounded p-2" id="taskDate"
                            name="date" required>
                        <img src="https://dashboard.codeparrot.ai/api/image/Z8wZ59G_8Dy7NbBA/cal-2.png" alt="Calendar"
                            class="calendar-icon absolute right-2 top-2 w-6 h-6 cursor-pointer"
                            onclick="document.getElementById('taskDate').showPicker()">
                    </div>
                </div>

                <div class="form-group">
                    <label class="block font-semibold mb-1">Priority</label>
                    <div class="priority-options flex space-x-4">
                        <div class="priority-option flex items-center space-x-2">
                            <span class="dot extreme w-2 h-2 bg-red-500 rounded-full"></span>
                            <span>Low</span>
                            <input type="radio" name="priority" value="low" required>
                        </div>
                        <div class="priority-option flex items-center space-x-2">
                            <span class="dot moderate w-2 h-2 bg-blue-500 rounded-full"></span>
                            <span>Medium</span>
                            <input type="radio" name="priority" value="medium" required>
                        </div>
                        <div class="priority-option flex items-center space-x-2">
                            <span class="dot low w-2 h-2 bg-green-500 rounded-full"></span>
                            <span>High</span>
                            <input type="radio" name="priority" value="high" required>
                        </div>
                    </div>
                </div>

                <div class="form-container flex space-x-4">
                    <div class="task-description flex-1">
                        <label class="block font-semibold mb-1">Task Description</label>
                        <textarea class="w-full border rounded p-2 h-32" name="description" placeholder="Start writing here....." required></textarea>
                    </div>

                    <div class="upload-section flex-1">
                        <label class="block font-semibold mb-1">Upload Image</label>
                        <div class="upload-container border rounded p-4 text-center">
                            <div class="upload-content">
                                <img src="https://dashboard.codeparrot.ai/api/image/Z8wZ59G_8Dy7NbBA/group-53.png"
                                    alt="Upload" class="upload-icon mx-auto mb-2">
                                <p>Drag & Drop files here</p>
                                <p>or</p>
                                <input type="file" class="hidden" id="taskImage" name="image">
                                <button type="button" class="browse-btn border rounded px-4 py-1 mt-2"
                                    onclick="document.getElementById('taskImage').click()">Browse</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="done-btn bg-red-500 text-white rounded px-6 py-2 mt-4 hover:bg-red-600">Done</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
