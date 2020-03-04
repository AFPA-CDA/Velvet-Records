// Executes the following code when the DOM content has been loaded
document.addEventListener("DOMContentLoaded", function () {
  // On form submit
  document.forms[0].addEventListener("submit", function (e) {
    // It prevents the form being submitted if there are any errors
    e.preventDefault();

    // Defines the error array
    const hasErrors = [];

    // Here lies all the regex used for this form
    const isNotDangerous = /^[^<>&]+$/i;

    // Here lies all the elements used for the form
    const artistName = document.getElementById("name");

    // Here lies all the elements used to show errors to the user
    const artistNameError = artistName.nextElementSibling;

    // If the value is not empty and not valid
    if (isNotDangerous.test(artistName.value) === false && artistName.value !== "") {
      artistNameError.textContent = "Le nom n'est pas valide.";
      artistNameError.style.display = "inline";
      hasErrors[0] = true;
    } else if (artistName.value === "") {
      // If the value is empty
      artistNameError.textContent = "Le nom est requis.";
      artistNameError.style.display = "inline";
      hasErrors[0] = true
    } else {
      // If the value is valid
      artistNameError.textContent = "";
      artistNameError.style.display = "none";
      hasErrors[0] = false;
    }

    // If there aren't any errors
    if (!hasErrors.includes(true)) {
      if (document.forms["createArtist"]) {
        Swal.fire({
          icon: "success",
          timer: 1500,
          title: "L'artiste a été modifié !",
          showClass: {
            popup: "animated fadeInDown faster"
          },
          showConfirmButton: false
        }).then(_ => {
          // Send the form
          document.forms["createArtist"].submit();
        });
      }
    }
  });
});