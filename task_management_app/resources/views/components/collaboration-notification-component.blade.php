<div>
    <div class="fixed hidden inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-20"
        id="collaboNotificationPopup">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md relative">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-xl font-semibold">Collaboration Notification</h2>
                <button class="text-gray-500 hover:text-gray-700" id="closeCollaboPopup">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4 space-y-4">
                @if ($collaborationNotification->count())
                    @foreach ($collaborationNotification as $notification)
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <img alt="Thumbnail of Juice Slider" class="w-12 h-12 rounded-full"
                                    src="{{ $notification->user->getImgUrl() }}" />
                            </div>
                            <div class="w-[100%]">
                                <p class="text-gray-700">
                                    {{ "$notification->body." }}
                                </p>
                                <div class="flex items-center gap-[1rem]">
                                    <button
                                        class="bg-green-300 w-[5rem] h-[2rem] rounded border border-black-500 hover:bg-green-300"><a
                                            href="{{ route('accept.collaboration', $notification->id) }}"
                                            class="">Accept</a></button>
                                    <button
                                        class="bg-red-300 w-[5rem] h-[2rem] rounded border border-black-500 hover:bg-red-300"><a
                                            href="{{ route('reject.collaboration', $notification->id) }}">Reject</a></button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                @endif

            </div>
        </div>
    </div>

</div>
