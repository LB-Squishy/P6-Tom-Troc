// Gère la soumission du formulaire avec la modale de confirmation Bootstrap
document.addEventListener("DOMContentLoaded", function () {
    const bookCoverForm = document.getElementById("bookCoverForm");
    // Vérifie si l'élément bookCoverForm existe avant de continuer
    if (bookCoverForm) {
        const confirmbookCoverButton = document.getElementById("confirmbookCoverButton");
        const cancelbookCoverButton = document.getElementById("cancelbookCoverButton");
        const bookCoverModalLabel = document.getElementById("bookCoverModalLabel");
        const modalFooter = confirmbookCoverButton.closest(".modal-footer");

        // Gérer le clic sur le bouton Confirmer
        confirmbookCoverButton.addEventListener("click", function () {
            if (bookCoverForm.bookCover.files.length > 0) {
                modalFooter.style.display = "none";
                // confirmationMessage.style.display = "none";
                bookCoverModalLabel.textContent = "Modification en cours...";

                setTimeout(() => {
                    bookCoverModalLabel.textContent = "Changement effectué";
                    setTimeout(() => {
                        bookCoverForm.submit();
                    }, 500);
                }, 1000);
            } else {
                alert("Veuillez sélectionner une image avant de confirmer.");
            }
        });

        // Gérer le clic sur le bouton Annuler
        cancelbookCoverButton.addEventListener("click", function () {
            const modal = document.getElementById("bookCoverModal");
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    }
});
