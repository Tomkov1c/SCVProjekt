function getPage () {
    var inner = event.target.innerHTML;
    let string = inner.toLowerCase();

    let path = string + ".txt";
    var filePath = 'projects/' + path;
    fetch(filePath)
    .then(response => response.text())
    .then(content => {
        document.getElementById('sectionR').innerHTML = content;
    })
}