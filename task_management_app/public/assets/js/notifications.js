//Notification Sound
document
    .getElementById("notificationButton")
    .addEventListener("click", function () {
        const popup = document.getElementById("notificationPopup");
        popup.classList.toggle("hidden");

        const soundEnabled = document.getElementById("toggleSound").checked;
        if (soundEnabled) {
            document.getElementById("notificationSound").play();
        }
    });
document
    .getElementById("notificationButton")
    .addEventListener("click", function () {
        document.getElementById("notificationPopup").classList.remove("hidden");
    });

document.getElementById("closePopup").addEventListener("click", function () {
    document.getElementById("notificationPopup").classList.add("hidden");
});

document
    .getElementById("notificationPopup")
    .addEventListener("click", function (event) {
        if (event.target === this) {
            document
                .getElementById("notificationPopup")
                .classList.add("hidden");
        }
    });
