<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
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
                <!-- Notification Items -->
                <!-- Repeat this block for each notification -->
                @if ($notifications->count())
                    @foreach ($notifications as $notification)
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img class="w-12 h-12 rounded" height="50"
                                    src="{{ $notification->task->getImgUrl() }}" width="50" />
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-700">
                                    <span class="font-semibold">{{ $notification->title }}</span>.
                                </p>
                                <p class="text-red-500">
                                    Priority: <span class="font-semibold">{{ $notification->task->priority }}</span>
                                </p>
                                <p class="text-gray-400">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach

                @endif
                <!-- End of Notification Item -->
            </div>
        </div>
    </div>

</div>
