$(document).ready(function() {
  // change background of div1 to user selected color on click.
  $("#colorButton").click(function() {
    var contents = $("#colorChange").val();
    $(".div1").css("background", contents)
  });
  // on click, alert "You clicked!"
  $("#alertButton").click(function(){
    alert("You clicked!");
  });
  // on click, fade div3 in and out slow.
  $("#fadeButton").click(function(){
    $(".div3").fadeToggle("5000ms");
  });
});
