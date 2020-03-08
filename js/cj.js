
(function($) {
  "use strict";

  // Collapse Navbar
  var navbarCollapse = function() {
    if ($("#mainNav").offset().top > 80) {
      $("#mainNav").addClass("navbar-scrolled");
    } else {
      $("#mainNav").removeClass("navbar-scrolled");
    }
  };
  // Collapse now if page is not at top
  navbarCollapse();
  // Collapse the navbar when page is scrolled
  $(window).scroll(navbarCollapse);

  // Closes responsive menu when a scroll trigger link is clicked
  $('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
  });

  $('.navbar-toggler').click(function() {
    $('.navbar-collapse').collapse('hide');
  });


var originalModal = $('#login').clone();
$(document).on('#login', 'hidden.bs.modal', function () {
    $('#login').remove();
    var myClone = originalModal.clone();
    $('body').append(myClone);
});

var originalModal2 = $('#signUp').clone();
$(document).on('#login', 'hidden.bs.modal', function () {
    $('#signUp').remove();
    var myClone = originalModal.clone();
    $('body').append(myClone);
});


})(jQuery); // End of use strict

// Select all tabs
$('.nav-tabs a').click(function(){
  $(this).tab('show');
})

// Select tab by name
$('.nav-tabs a[href="#home"]').tab('show')

// Select first tab
$('.nav-tabs a:first').tab('show')



$('.carousel.carousel-multi-item.v-2 .carousel-item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=0;i<4;i++) {
    next=next.next();
    if (!next.length) {
      next=$(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
  }
});

//document.getElementById("registration").onsubmit = function() {formValidationx()};
/*function formValidation()
{
var passid = document.getElementsById("rpassword");
var uname = document.getElementsById("rname");
var fname = document.getElementsById("rfullname");

var uadd =document.getElementsById("password");
var material = document.getElementsById("address");



if(passid_validation(passid,7,12))
{
if(allLetter(uname))
{
if(allLetters(fname))
{
if(alphanumeric(uadd))
{
if(materialselect(material))
{
}
}
}
}
}

return false;
}

function passid_validation(passid,mx,my)
{
var passid_len = passid.value.length;
if (passid_len == 0 ||passid_len >= my || passid_len < mx)
{
alert("Password should not be empty / length be between "+mx+" to "+my);
passid.focus();
return false;
}
return true;
}


function allLetter(uname)
{
var letters = /^[0-9a-zA-Z]+$/;

if(uname.value.match(letters))
{
return true;
}
else
{
alert('Username must have alphanumeric characters only');
uname.focus();
return false;
}
}


function allLetters(fname)
{
  var letters = /^[A-Za-z]+$/;
  if(fname.value.match(letters))
  {
  return true;
  }
  else
  {
  alert('Fullname must have alphabet characters only');
  fname.focus();
  return false;
  }

}


function alphanumeric(uadd)
{
var letters = /^[0-9a-zA-Z]+$/;
if(uadd.value.match(letters))
{
return true;
}
else
{
alert('User address must have alphanumeric characters only');
uadd.focus();
return false;
}
}



function materialselect(material)
{
if(material.value == "Default")
{
alert('Select your country from the list');
material.focus();
return false;
}
else
{
return true;
}
}*/
