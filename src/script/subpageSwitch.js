function switchSub(path, d) {
    document.getElementById("iframe").src = path;
    
    document.getElementById("active").id = "";
    d.id = "active";

}

// var tabs = document.getElementById("sectionL").children;
// document.addEventListener('keydown', function(event) {
//     if (event.altKey && sessionStorage.getItem("altSwicth") == "on") {
//         event.preventDefault();
//         var key = parseInt(event.key, 10);
//         var index = key - 1;
//         if (index >= 0 && index < tabs.length) {
//             tabs[index].click();
//         }
//     }
// });
// 
// 
// function changeAlt() {
//     if (sessionStorage.getItem("altSwicth") == "off") {
//       sessionStorage.setItem("altSwicth", "on");
//     }else {
//       sessionStorage.setItem("altSwicth", "off");
//     }
//     if(sessionStorage.getItem("altSwicth") == null) {
//         sessionStorage.setItem("altSwicth", "off");
//     }
//   }
//   
// document.addEventListener('DOMContentLoaded', function() {
//   decide();
// }, false);
// 
// function decide() {
//     if(sessionStorage.getItem("altSwicth") == "on" && document.getElementById("checkbox2") != null) {
//       document.getElementById("checkbox2").checked = true;
//     }
//     else{
//         document.getElementById("checkbox2").checked = false;
//     }
//   }
//   