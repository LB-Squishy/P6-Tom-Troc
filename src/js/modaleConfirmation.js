// Gère la soumission du formulaire avec la modale de confirmation Bootstrap
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const confirmButton = document.getElementById('confirmButton');
    const cancelButton = document.getElementById('cancelButton');
    const confirmationMessage = document.getElementById('confirmationMessage');
    const modalHeader = document.getElementById('confirmationModalLabel');
    const modalFooter = confirmButton.closest('.modal-footer');

    // Gérer le clic sur le bouton Confirmer
    confirmButton.addEventListener('click', function () {
        modalFooter.style.display = 'none';
        confirmationMessage.style.display = 'none';
        modalHeader.textContent = 'Modification en cours...';

        setTimeout(() => {
            modalHeader.textContent = 'Changement effectué';
            setTimeout(() => {
                form.submit();
            }, 500);
        }, 1000);
    });

    // Gérer le clic sur le bouton Annuler
    cancelButton.addEventListener('click', function () {
        location.reload();
    });
});