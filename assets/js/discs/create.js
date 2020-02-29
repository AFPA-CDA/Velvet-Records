// Executes the following code when the DOM content has been loaded
document.addEventListener("DOMContentLoaded", function () {
  const image = document.getElementById("image");
  const imagePreview = document.getElementById("imagePreview");

  // On image change
  image.addEventListener("change", function () {
    // Creates a new
    const reader = new FileReader();

    // Handles reader on load event
    reader.onload = function (e) {
      imagePreview.src = e.target.result;
    };

    // Reads the file as a data URL
    reader.readAsDataURL(this.files[0]);
  });

  // On createDisc form submit
  document.forms["createDisc"].addEventListener("submit", function (e) {
    // It prevents the form being submitted if there is any error
    e.preventDefault();

    // Defines the errors array
    const hasErrors = [];

    // Here lies all the regex used for this form
    const isAlpha = /^[\wÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'’\s-]+$/i;
    const isAllowedExtension = /(\.jpg|\.jpeg|\.png)$/i;
    const isNumeric = /^(\d{1,4}[.])?\d{2}$/;
    const isYear = /^[1-2]\d{3}$/;

    // Here lies all the elements used for the form
    const artists = document.getElementById("artists");
    const filePath = document.getElementById("filePath");
    const genre = document.getElementById("genre");
    const label = document.getElementById("label");
    const price = document.getElementById("price");
    const title = document.getElementById("title");
    const year = document.getElementById("year");

    // Here lies all the elements used to show errors to the user
    const artistsError = document.getElementById("artistsError");
    const filePathError = filePath.nextElementSibling;
    const genreError = genre.nextElementSibling;
    const labelError = label.nextElementSibling;
    const priceError = price.nextElementSibling;
    const titleError = title.nextElementSibling;
    const yearError = year.nextElementSibling;

    // If the value is not empty and not valid
    if (isAlpha.test(title.value) === false && title.value !== "") {
      titleError.textContent = "Le titre n'est pas valide.";
      titleError.style.display = "inline";
      hasErrors[0] = true;
    } else if (title.value === "") {
      // If the value is empty
      titleError.textContent = "Le titre est requis.";
      titleError.style.display = "inline";
      hasErrors[0] = true
    } else {
      // If the value is valid
      titleError.textContent = "";
      titleError.style.display = "none";
      hasErrors[0] = false;
    }

    if (artists.options[artists.selectedIndex].value === "") {
      artistsError.textContent = "Vous devez choisir un artiste.";
      artistsError.style.display = "inline";
      hasErrors[1] = true;
    } else {
      artistsError.textContent = "";
      artistsError.style.display = "none";
      hasErrors[1] = false;
    }

    if (isYear.test(year.value) === false && year.value !== "") {
      yearError.textContent = "L'année n'est pas valide.";
      yearError.style.display = "inline";
      hasErrors[2] = true;
    } else if (year.value === "") {
      yearError.textContent = "L'année est requise.";
      yearError.style.display = "inline";
      hasErrors[2] = true;
    } else {
      yearError.textContent = "";
      yearError.style.display = "none";
      hasErrors[2] = false;
    }

    if (isAlpha.test(genre.value) === false && genre.value !== "") {
      genreError.textContent = "Le genre n'est pas valide.";
      genreError.style.display = "inline";
      hasErrors[3] = true;
    } else if (genre.value === "") {
      genreError.textContent = "Le genre est requis.";
      genreError.style.display = "inline";
      hasErrors[3] = true
    } else {
      genreError.textContent = "";
      genreError.style.display = "none";
      hasErrors[3] = false;
    }

    if (isAlpha.test(label.value) === false && label.value !== "") {
      labelError.textContent = "Le label n'est pas valide.";
      labelError.style.display = "inline";
      hasErrors[4] = true;
    } else if (label.value === "") {
      labelError.textContent = "Le label est requis.";
      labelError.style.display = "inline";
      hasErrors[4] = true
    } else {
      labelError.textContent = "";
      labelError.style.display = "none";
      hasErrors[4] = false;
    }

    if (isNumeric.test(price.value) === false && price.value !== "") {
      priceError.textContent = "Le prix n'est pas valide.";
      priceError.style.display = "inline";
      hasErrors[5] = true;
    } else if (price.value === "") {
      priceError.textContent = "Le prix est requis.";
      priceError.style.display = "inline";
      hasErrors[5] = true
    } else {
      priceError.textContent = "";
      priceError.style.display = "none";
      hasErrors[5] = false;
    }

    if (isAllowedExtension.test(filePath.value) === false && filePath.value !== "") {
      filePathError.textContent = "Seul les images [jpg|jpeg|png] sont acceptées.";
      filePathError.style.display = "inline";
      hasErrors[6] = true;
    } else if (filePath.value === "") {
      filePathError.textContent = "L'image est requise.";
      filePathError.style.display = "inline";
      hasErrors[6] = true;
    } else {
      filePathError.textContent = "";
      filePathError.style.display = "none";
      hasErrors[6] = false;
    }

    // If there aren't any errors
    if (!hasErrors.includes(true)) {
      // Send the form
      document.forms["createDisc"].submit();
    }
  })
});