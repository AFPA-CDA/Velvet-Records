// When the dom content has been loaded we call all the materialize init functions
document.addEventListener('DOMContentLoaded', function () {
  const fabs = document.querySelectorAll(".fixed-action-btn");
  const modals = document.querySelectorAll(".modal");
  const selects = document.querySelectorAll("select");
  const sidenav = document.querySelectorAll('.sidenav');

  M.FloatingActionButton.init(fabs, {hoverEnabled: false, toolbarEnabled: true});
  M.Modal.init(modals);
  M.FormSelect.init(selects, {dropdownOptions: {alignment: "bottom"}});
  M.Sidenav.init(sidenav);
});
