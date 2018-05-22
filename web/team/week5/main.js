document.addEventListener('DOMContentLoaded', () => {

  var bookDropdown = document.querySelector('select.book-dropdown');

  bookDropdown.addEventListener('change', (e) => {
    var value = e.target.value;
    if (value != "") {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
          //process results
          handleScriptureJson(xhr.responseText);
        }
      };
      xhr.open("GET", "./api.php?book=" + value, true);
      xhr.send();
    }
  });
});

function handleScriptureJson(jsonString) {
  var book = document.querySelector('select.book-dropdown').value;
  var scriptures = JSON.parse(jsonString);
  var list = document.querySelector('ul.scripture-list');

  destroyChildren(list);

  scriptures.forEach(s => {
    var li = document.createElement('li');
    var a = document.createElement('a');
    var text = document.createTextNode(`${book} ${s.chapter}:${s.verse}`);
    a.appendChild(text);
    a.setAttribute('href', `./scripture.php?book=${book}&chapter=${s.chapter}&verse=${s.verse}`);
    li.appendChild(a);
    list.appendChild(li);
  })
}

function destroyChildren (element) {
  element.innerHTML = "";
}