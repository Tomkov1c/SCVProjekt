function change() {
  if (sessionStorage.getItem("darkMode") == "dark") {
    sessionStorage.setItem("darkMode", "light");
  }else {
    sessionStorage.setItem("darkMode", "dark");
  }
}

document.addEventListener('DOMContentLoaded', function() {
  decide();
}, false);

window.setInterval( function(){
  decide();
},50)

function decide() {
  if(sessionStorage.getItem("darkMode") == "dark" && document.getElementById("checkbox") != null) {
    document.getElementById("checkbox").checked = true;
  }
  if(sessionStorage.getItem("darkMode") != null) {
    document.querySelector("#darmModeID").dataset.theme = sessionStorage.getItem("darkMode");
  }else {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      sessionStorage.setItem("darkMode", "dark")
    }else {
      sessionStorage.setItem("darkMode", "light")
    }
    document.querySelector("#darmModeID").dataset.theme = sessionStorage.getItem("darkMode");
  }
}