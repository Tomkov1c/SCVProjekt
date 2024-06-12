document.addEventListener('keydown', (event) => {
  if(event.ctrlKey && (event.key ==  "Q" || event.key ==  "q") ) {
    if (document.getElementById("devMenu").style.display == "block") {
        document.getElementById("devMenu").style.display = "none";
    }else {
        document.getElementById("devMenu").style.display = "block";
    }
  }
}, false);