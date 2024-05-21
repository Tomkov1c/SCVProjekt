document.addEventListener('keydown', (event) => {
  if(event.ctrlKey && event.key ==  "Q" ) {
    if (document.getElementById("devMenu").style.display == "block") {
        document.getElementById("devMenu").style.display = "none";
    }else {
        document.getElementById("devMenu").style.display = "block";
    }
  }
}, false);