function switchSub(path, d) {
    document.getElementById("iframe").src = path;
    
    document.getElementById("active").id = "";
    d.id = "active";

}

var tabs = document.getElementById("sectionL").children;
document.addEventListener('keydown', function(event) {
    if (event.altKey) {
        event.preventDefault();
        var key = parseInt(event.key, 10);
        var index = key - 1;
        if (index >= 0 && index < tabs.length) {
            tabs[index].click();
        }
    }
});