$(document).ready(function() {
  // change background of div1 to user selected color on click.
  $("#hamburger").click(function() {
    $("#mobileNav").toggleClass("clicked");
    $("#buttons").toggleClass("open");
    

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
