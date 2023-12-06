const article = document.querySelector("#darmModeID");
document.addEventListener('keypress', (event) => {
  var code = event.code;
  if(code == "KeyD") {
    if(article.getAttribute("data-theme") == "light")
    {
      document.querySelector("#darmModeID").dataset.theme = "dark";
      var temp = document.getElementsByTagName("iframe").document;
      var html = temp.getAttribute("theme") = "light"


    }else {
      document.querySelector("#darmModeID").dataset.theme = "light";
    }
  }
}, false);
