let el = document.getElementById('username');
let fontSize = parseInt(el.style.fontSize);

function isOverflown(element) {
    return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
}

for (let i = fontSize; i >= 0; i--) {
    let overflow = isOverflown(el);
    if (overflow) {
        fontSize--;
        fontSize--;
        el.style.fontSize = fontSize + "px";    
}
}

let sidemenu = document.getElementById('sidenav');
console.log('JS za ta file je dash.js - ce ga spreminjas napisi kaj, da lahka jst (Gal Pungartnik) vem kk napisat php');
