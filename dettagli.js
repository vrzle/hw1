document.addEventListener("DOMContentLoaded", function() {
    var menuButton = document.getElementById("menu");
    var menuExt = document.getElementById("menu_ext");
    
    menuButton.addEventListener("click", function() {
      menuExt.style.display = menuExt.style.display === "none" ? "block" : "none";
    });
  });
  