// Gère la soumission du formulaire avec la modale de confirmation Bootstrap
document.addEventListener("DOMContentLoaded", function () {
    const photoForm = document.getElementById("photoForm");
    const confirmPhotoButton = document.getElementById("confirmPhotoButton");
    const cancelPhotoButton = document.getElementById("cancelPhotoButton");
    const photoModalLabel = document.getElementById("photoModalLabel");
    const modalFooter = confirmButton.closest(".modal-footer");

    // Gérer le clic sur le bouton Confirmer
    confirmPhotoButton.addEventListener("click", function () {
        if (photoForm.photo.files.length > 0) {
            modalFooter.style.display = "none";
            confirmationMessage.style.display = "none";
            photoModalLabel.textContent = "Modification en cours...";

            setTimeout(() => {
                photoModalLabel.textContent = "Changement effectué";
                setTimeout(() => {
                    photoForm.submit();
                }, 500);
            }, 1000);
        } else {
            alert("Veuillez sélectionner une photo avant de confirmer.");
        }
    });

    // Gérer le clic sur le bouton Annuler
    cancelPhotoButton.addEventListener("click", function () {
        location.reload();
    });
});
