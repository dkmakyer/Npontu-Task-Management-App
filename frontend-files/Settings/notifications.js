// JavaScript to toggle the notification popup
document.getElementById('notificationButton').addEventListener('click', function() {
    const popup = document.getElementById('notificationPopup');
    popup.classList.toggle('hidden');
});

document.getElementById('closePopup').addEventListener('click', function() {
    const popup = document.getElementById('notificationPopup');
    popup.classList.add('hidden');
});

//Notification Sound 
document.getElementById('notificationButton').addEventListener('click', function () {
    const popup = document.getElementById('notificationPopup');
    popup.classList.toggle('hidden');

    const soundEnabled = document.getElementById('toggleSound').checked;
    if (soundEnabled) {
        document.getElementById('notificationSound').play();
    }
});

document.getElementById('closePopup').addEventListener('click', function () {
    const popup = document.getElementById('notificationPopup');
    popup.classList.add('hidden');
});