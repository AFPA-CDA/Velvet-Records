// When the DOM Content has been loaded
document.addEventListener("DOMContentLoaded", function () {
  // Gets the delete button
  const deleteButton = document.getElementById("deleteButton");

  // Removes the href if javascript is enabled
  deleteButton.href = "#";

  // When someones clicks on the delete button
  deleteButton.addEventListener("click", function () {

    // Asks the user if he is sure
    Swal.fire({
      cancelButtonText: "Annuler",
      cancelButtonColor: "#f44336",
      confirmButtonText: "Supprimer",
      confirmButtonColor: "#ff5722",
      icon: "warning",
      title: "Êtes vous sûr ?",
      showClass: {
        popup: "animated fadeInDown faster"
      },
      showCancelButton: true
    }).then(result => {
      // If the user is sure
      if (result.value) {
        // Show the user that the disc has been deleted
        Swal.fire({
          icon: "success",
          timer: 1500,
          title: "Le disque a été supprimé !",
          showClass: {
            popup: "animated fadeInDown faster"
          },
          showConfirmButton: false
        }).then(_ => {
          // Redirects to the delete controller in order to delete the disc from the database
          window.location.href = `../../controllers/discs/delete.php?disc_id=${deleteButton.dataset.id}`
        });
      } else {
        // If the user cancelled
        Swal.fire({
          icon: "info",
          timer: 1500,
          title: "Le disque n'a pas été supprimé !",
          showClass: {
            popup: "animated fadeInDown faster"
          },
          showConfirmButton: false
        });
      }
    });
  });
});