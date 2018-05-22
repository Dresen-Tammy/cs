function clicked() {
  alert("Clicked!");
}

function changeColor() {
  var color = document.getElementById('colorChange').value;
  var div1 = document.getElementById('div1');

  div1.style.background = color;
}
