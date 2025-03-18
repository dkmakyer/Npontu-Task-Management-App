@if ($collaborationNotifications->count())
    @foreach ($collaborationNotifications as $notification)
        <div class="">
            <p>{{ $notification->body }}</p> <button id="accept" onclick="accept(this)"
                data-url="{{ route('accept.collaboration', $notification->id) }}"> accept </button>

        </div>
    @endforeach

@endif

@if ($owners)
    @foreach ($owners as $owner)
        <div class="">
            <p class="">You are now collaborating with {{ $owner->username }}</p>
        </div>
    @endforeach

@endif

<script>
    function accept(event) {
        const url = event.dataset.url;
        window.location.href = url;
    }
</script>
