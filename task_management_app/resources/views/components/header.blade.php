@props(['pageName'])
<header class="flex justify-between items-center shadow-md bg-gray-50 mb-8 fixed w-full p-4 z-10">
    <div class="flex items-center">
        <h1 class="text-2xl font-bold text-red-500">

            <span class="text-black">{{ $pageName }}</span>

        </h1>
    </div>
    <div class="flex-1 flex justify-center">
        <div class="relative w-[35rem]">
            @if ($pageName === 'My Tasks')
                <form action="{{ route('search.task') }}" method="get">
                    <input class="p-2 border rounded w-full h-[2rem] text-[12px] shadow-md bg-gray-50"
                        placeholder="Search your task here..." type="text" name="search" />
                    <div
                        class="absolute right-0 top-0 bg-red-200 p-2 rounded h-[2rem] flex items-center justify-center">
                        <button type="submit">
                            <i class="fas fa-search text-black"></i>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <div class="flex items-center">
        @if ($pageName == 'Settings' || $pageName == 'My Tasks' || $pageName == 'Update Task' || $pageName == 'Completed Tasks')
            <div class="bg-red-200 p-2 rounded h-[2rem] flex items-center justify-center mr-4 cursor-pointer"
                id="notificationButton">
                <i class="fas fa-bell text-black text-xl"></i>
            </div>
        @endif
        {{-- <a href="../Settings/Settings.html">
            <div class="bg-red-400 p-2 rounded h-[2rem] flex items-center justify-center mr-4">
                <i class="fas fa-cog text-white text-xl"></i>
            </div>
        </a> --}}
        <p class="text-gray-500 flex flex-col items-center">
            {{ date('l') }} <span class="text-[15px] text-black-400">{{ date('d/m/Y') }}</span>
        </p>
    </div>
</header>
