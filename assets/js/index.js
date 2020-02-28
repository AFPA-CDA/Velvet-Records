// When the dom content has been loaded we call all the materialize init functions
document.addEventListener("DOMContentLoaded", function () {
  // Grabs all the materialize element
  const materialBox = document.querySelectorAll(".materialboxed");
  const selects = document.querySelectorAll("select");
  const sidenav = document.querySelectorAll(".sidenav");
  const fabs = document.querySelectorAll(".fixed-action-btn");

  // Init all the materialize.css js components
  M.Materialbox.init(materialBox);
  M.FormSelect.init(selects);
  M.Sidenav.init(sidenav);
  M.FloatingActionButton.init(fabs, {
    hoverEnabled: false,
    toolbarEnabled: true
  });
});