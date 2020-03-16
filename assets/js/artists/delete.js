// When the DOM Content has been loaded
document.addEventListener("DOMContentLoaded", function () {
    // Gets the delete buttons
    const deleteButtons = document.querySelectorAll("a[id^='deleteButton']");

    // For each delete buttons
    deleteButtons.forEach(el => {
        // Removes the href for all delete buttons if javascript is enabled
        el.href = "#";

        // Adds an on click event for each deleteButtons
        el.addEventListener("click", function (e) {
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
                        title: "L'artiste a été supprimé !",
                        showClass: {
                            popup: "animated fadeInDown faster"
                        },
                        showConfirmButton: false
                    }).then(_ => {
                        // Redirects to the delete controller in order to delete the artist from the database
                        window.location.href = `../../controllers/artists/delete.php?artist_id=${el.dataset.id}&crsf_token=${el.dataset.token}`
                    });
                } else {
                    // If the user cancelled
                    Swal.fire({
                        icon: "info",
                        timer: 1500,
                        title: "L'artiste n'a pas été supprimé !",
                        showClass: {
                            popup: "animated fadeInDown faster"
                        },
                        showConfirmButton: false
                    });
                }
            })
        });
    });
});