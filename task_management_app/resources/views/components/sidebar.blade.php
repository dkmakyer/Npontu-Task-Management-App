@props(['user'])

<aside class="w-72 bg-black text-white fixed h-full top-12 left-0 py-8 px-6">
    <div class="flex flex-col items-center">
        <div class="relative w-24 h-24 mb-4">
            <img src="https://storage.googleapis.com/a1aa/image/rUXZDbcIOfUN6UNKIx9JV_yYtjGio_UQcHrU_9LlOOg.jpg"
                alt="User Profile" class="rounded-full border-4 border-gray-200 w-full h-full">
        </div>
        <p class="text-lg font-semibold">{{ $user->first_name }}</p>
        <p class="text-sm text-gray-400">{{ $user->email }}</p>
    </div>
    <nav class="mt-8 space-y-3">
        <a href="{{ route('dashboard') }}" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
        </a>
        <a href="../Vital Task/vitals-tm.html" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-tasks mr-3"></i> Vital Task
        </a>
        <a href="../My Task/My Task.html" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-list mr-3"></i> My Task
        </a>
        <a href="../Category/task-categories.html" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-tags mr-3"></i> Task Categories
        </a>
        <a href="../Settings/Settings.html" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-cog mr-3"></i> Settings
        </a>
        <a href="#" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-question-circle mr-3"></i> Help
        </a>
    </nav>
    <div class="mt-8">
        <a href="{{ route('logout') }}" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-sign-out-alt mr-3"></i> Logout
        </a>
    </div>
</aside>
