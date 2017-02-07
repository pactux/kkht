function menuMobile() {
  var botMobile = document.getElementById("navbar");

  if (botMobile.getAttribute("class") == "collapse navbar-collapse") {
    botMobile.setAttribute("class", "collapse in navbar-collapse");
  }
  else {
    botMobile.setAttribute("class", "collapse navbar-collapse");
  }
}

function subMenu(menu) {
  if (menu.getAttribute("class") == 'dropdown') {
    menu.setAttribute("class", "dropdown open");
  }
  else {
    menu.setAttribute("class", "dropdown");
  }
}

function fechaAlerta(tag) {
	tag.parentNode.style.display = "none";
}
