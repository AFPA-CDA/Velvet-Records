// Get delete button
const deleteButton = document.getElementById("deleteButton");

// Get the disc id from the data-id attribute
const discId = deleteButton.getAttribute("data-id");

// When the user clicks on the delete button
deleteButton.addEventListener("click", function () {
  // Shows an alert that asks if the user truly wants to delete the disc
  Swal.fire({
    cancelButtonColor: "#f44336",
    cancelButtonText: "Annuler",
    confirmButtonColor: "#ff5722",
    confirmButtonText: "Je suis sûr",
    icon: "warning",
    title: "Êtes vous sûr ?",
    text: "Vous ne pourrez pas revenir en arrière !",
    showCancelButton: true
  }).then(result => {
    // If the user says yes
    if (result.value) {
      // Shows to the user that the disc has been deleted
      Swal.fire("Supprimé", "Le disque à été supprimé.", "success").then(_ => {
        // Redirects to the delete controller to delete the disc in the database
        window.location.href = `../../../controllers/discs/delete.php?disc_id=${discId}`
      })
    }
  })
});