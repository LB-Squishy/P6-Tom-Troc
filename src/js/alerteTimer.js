// Fonction pour faire disparaître le message après 2 secondes
window.addEventListener("DOMContentLoaded", () => {
    const successMessage = document.getElementById("success-message");

    // Si un message de succès est présent, le cacher après 2 secondes
    if (successMessage) {
        setTimeout(() => {
            successMessage.classList.remove("show");
        }, 1500);
    }
});
