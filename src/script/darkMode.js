const article = document.querySelector("#darmModeID");
document.addEventListener('keypress', (event) => {
  var code = event.code;
  if(code == "KeyD") {
    if(article.getAttribute("data-theme") == "light")
    {
      document.querySelector("#darmModeID").dataset.theme = "dark";
      localStorage.setItem("darkMode", "dark");


    }else {
      document.querySelector("#darmModeID").dataset.theme = "light";
      localStorage.setItem("darkMode", "light");

    }
  }
}, false);

document.addEventListener('DOMContentLoaded', function() {
  if(localStorage.getItem("darkMode") != null) {
    document.querySelector("#darmModeID").dataset.theme = localStorage.getItem("darkMode");
  }else {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      localStorage.setItem("darkMode", "dark")
    }else {
      localStorage.setItem("darkMode", "light")
    }
    document.querySelector("#darmModeID").dataset.theme = localStorage.getItem("darkMode");
  }
}, false);