const article = document.querySelector("#darmModeID");
document.addEventListener('keypress', (event) => {
  var code = event.code;
  if(code == "KeyD") {
    if(article.dataset.theme == "light")
    {
      article.dataset.theme = "dark";
    }else {
      article.dataset.theme = "light";
    }
  }
}, false);