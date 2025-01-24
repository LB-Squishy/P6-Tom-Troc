import modalsConfig from "./modalsConfig.js";

//Gestionnaire des modales (configurer les nouvelles modales dans madalsConfig.js)
document.addEventListener("DOMContentLoaded", () => {
    function handleModal({
        formId,
        confirmButtonId,
        cancelButtonId,
        modaleLabelId,
        modalId,
        messageId = null,
        inputFileName = null,
    }) {
        const form = document.getElementById(formId);
        // Vérifie si le form existe avant de continuer
        if (form) {
            const confirmButton = document.getElementById(confirmButtonId);
            const cancelButton = document.getElementById(cancelButtonId);
            const modalLabel = document.getElementById(modaleLabelId);
            const message = messageId ? document.getElementById(messageId) : null;
            const modalFooter = confirmButton.closest(".modal-footer");
            const fileName = document.getElementById(inputFileName);
            // Gérer le clic sur le bouton Confirmer
            confirmButton.addEventListener("click", () => {
                if (fileName && form[fileName]?.files.length === 0) {
                    alert("Veuillez sélectionner une image avant de confirmer.");
                    return;
                }
                if (message) {
                    message.style.display = "none";
                }

                modalFooter.style.display = "none";
                modalLabel.textContent = "Modification en cours...";

                setTimeout(() => {
                    modalLabel.textContent = "Changement effectué";
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }, 1000);
            });

            // Gérer le clic sur le bouton Annuler
            cancelButton.addEventListener("click", function () {
                const modal = document.getElementById(modalId);
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            });
        }
    }

    // Initialise les modales
    modalsConfig.forEach(handleModal);
});
