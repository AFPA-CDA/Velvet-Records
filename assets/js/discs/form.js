// Executes the following code when the DOM content has been loaded
document.addEventListener("DOMContentLoaded", function () {
  const image = document.getElementById("image");
  const imagePreview = document.getElementById("imagePreview");

  // On image change
  image.addEventListener("change", function () {
    // Creates a new FileReader
    const reader = new FileReader();

    // Handles reader on load event
    reader.onload = function (e) {
      // Sets the image preview src to the current image being selected
      imagePreview.src = e.target.result;
    };

    // Reads the file as a data URL
    reader.readAsDataURL(this.files[0]);
  });

  // On form submit
  document.forms[0].addEventListener("submit", function (e) {
    // It prevents the form being submitted if there is any error
    e.preventDefault();

    // Defines the errors array
    const hasErrors = [];

    // Here lies all the regex used for this form
    const isAlphaNumeric = /^[\w\W\s\dÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/i;
    const isAllowedExtension = /(\.jpg|\.jpeg|\.png)$/i;
    const isCorrectPrice = /^(\d{0,4}[.]?)\d{0,2}$/;
    const isYear = /^(19|20)\d{2}$/;

    // Here lies all the elements used for the form
    const artists = document.getElementById("artists");
    const filePath = document.getElementById("filePath");
    const genre = document.getElementById("genre");
    const label = document.getElementById("label");
    const price = document.getElementById("price");
    const title = document.getElementById("title");
    const year = document.getElementById("year");

    // If the value is not empty and not valid
    if (isAlphaNumeric.test(title.value) === false && title.value !== "") {
      hasErrors[0] = true;
    } else hasErrors[0] = title.value === "";

    hasErrors[1] = artists.options[artists.selectedIndex].value === "";

    if (isYear.test(year.value) === false && year.value !== "") {
      hasErrors[2] = true;
    } else hasErrors[2] = year.value === "";

    if (isAlphaNumeric.test(genre.value) === false && genre.value !== "") {
      hasErrors[3] = true;
    } else hasErrors[3] = genre.value === "";

    if (isAlphaNumeric.test(label.value) === false && label.value !== "") {
      hasErrors[4] = true;
    } else hasErrors[4] = label.value === "";

    if (isCorrectPrice.test(price.value) === false && price.value !== "") {
      hasErrors[5] = true;
    } else hasErrors[5] = price.value === "";

    if (isAllowedExtension.test(filePath.value) === false && filePath.value !== "") {
      hasErrors[6] = true;
    } else if (filePath.value === "") {
      hasErrors[6] = true;
    } else hasErrors[6] = image.files[0] && isAllowedExtension.test(filePath.value) && (image.files[0].size / 1024 / 1024) > 2;


    // If there aren't any errors
    if (!hasErrors.includes(true)) {
      if (document.forms["updateDisc"]) {
        // Shows the user that the disc has been updated
        Swal.fire("Mis à jour", "Le disque a été mis à jour !", "success").then(_ => {
          // Send the form
          document.forms["updateDisc"].submit();
        });
      }

      if (document.forms["createDisc"]) {
        // Shows the user that the disc has been created
        Swal.fire("Créée", "Le disque a été créée !", "success").then(_ => {
          // Send the form
          document.forms["createDisc"].submit();
        });
      }
    }
  })
});