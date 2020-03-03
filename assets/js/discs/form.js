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
});