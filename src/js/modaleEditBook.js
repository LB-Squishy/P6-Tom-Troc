// Gère la soumission du formulaire avec la modale de confirmation Bootstrap
document.addEventListener("DOMContentLoaded", function () {
    const editBookForm = document.getElementById("editBookForm");
    // Vérifie si l'élément editBookForm existe avant de continuer
    if (editBookForm) {
        const confirmEditBookButton = document.getElementById("confirmEditBookButton");
        const cancelEditBookButton = document.getElementById("cancelEditBookButton");
        const confirmationEditBookMessage = document.getElementById("confirmationEditBookMessage");
        const modalHeader = document.getElementById("confirmationEditBookModalLabel");
        const modalFooter = confirmEditBookButton.closest(".modal-footer");

        // Gérer le clic sur le bouton Confirmer
        confirmEditBookButton.addEventListener("click", function () {
            modalFooter.style.display = "none";
            confirmationEditBookMessage.style.display = "none";
            modalHeader.textContent = "Modification en cours...";

            setTimeout(() => {
                modalHeader.textContent = "Changement effectué";
                setTimeout(() => {
                    editBookForm.submit();
                }, 500);
            }, 1000);
        });

        // Gérer le clic sur le bouton Annuler
        cancelEditBookButton.addEventListener("click", function () {
            const modal = document.getElementById("editBookModal");
            const modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    }
});
