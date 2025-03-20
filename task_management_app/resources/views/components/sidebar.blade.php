@props(['user'])

<aside class="w-72 bg-black text-white fixed h-full top-12 left-0 py-8 px-6">
    <div class="flex flex-col items-center">
        <div class="relative w-24 h-24 mb-4">
            <img src="{{ $user->getImgUrl() }}" alt="User Profile"
                class="rounded-full border-4 border-gray-200 w-full h-full">
        </div>
        <p class="text-lg font-semibold">{{ $user->first_name }}</p>
        <p class="text-sm text-gray-400">{{ $user->email }}</p>
    </div>
    <nav class="mt-8 space-y-3">

        <a href="{{ route('all.tasks') }}" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fa fa-tasks mr-3"></i> All Tasks
        </a>

        <a href="{{ route('tasks') }}" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fa-solid fa-layer-group mr-3"></i> My Tasks
        </a>

        <a href="{{ route('settings') }}" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-cog mr-3"></i> Settings
        </a>
        <a href="{{ route('help') }}" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-question-circle mr-3"></i> Help
        </a>
    </nav>
    <div class="mt-8">
        <a href="{{ route('logout') }}" class="flex items-center text-gray-400 hover:text-red-400">
            <i class="fas fa-sign-out-alt mr-3"></i> Logout
        </a>
    </div>
</aside>
