// Fonction pour faire disparaître le message après 1.5 secondes
window.addEventListener("DOMContentLoaded", () => {
    const successMessage = document.getElementById("success-message");

    // Si un message de succès est présent, le cacher après 1.5 secondes
    if (successMessage) {
        setTimeout(() => {
            successMessage.classList.remove("show");
        }, 1500);
    }
});
