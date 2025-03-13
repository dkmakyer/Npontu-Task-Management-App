document.getElementById('notificationButton').addEventListener('click', function() {
    document.getElementById('notificationPopup').classList.remove('hidden');
});

document.getElementById('closePopup').addEventListener('click', function() {
    document.getElementById('notificationPopup').classList.add('hidden');
});

document.getElementById('notificationPopup').addEventListener('click', function(event) {
    if (event.target === this) {
        document.getElementById('notificationPopup').classList.add('hidden');
    }
});