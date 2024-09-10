(function($) {

	"use strict";

	$(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

})(jQuery);
const emailInput = document.getElementById('email');
const emailError = document.getElementById('email-error');

emailInput.addEventListener('input', () => {
  const email = emailInput.value;
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

  if (!emailRegex.test(email)) {
    emailError.textContent = 'Invalid email address';
  } else {
    emailError.textContent = '';
  }
});

const phoneInput = document.getElementById('phone');
const phoneError = document.getElementById('phone-error');

phoneInput.addEventListener('input', () => {
  const phone = phoneInput.value;
  const phoneRegex = /^\d+$/;

  if (!phoneRegex.test(phone)) {
    phoneError.textContent = 'Invalid phone number';
  } else {
    phoneError.textContent = '';
  }
});

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function validateForm() {
 if(emailError.textContent!=""){
    return false;
  }if(emailError.textContent!=""){
    return false;
  }
}
function displayModal(){
  const errormessage=getCookie("error");
  console.log(getCookie("error"));
  if(errormessage=="default"){
    $('.my-modal').modal('toggle');
    document.cookie = "error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  }
  else if(errormessage=="difpassword"){
    $('.modal-body').html("<p>Password not matches</p>");
    $('.my-modal').modal('toggle');
    document.cookie = "error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  }
  else if(errormessage=="passlength"){
    $('.modal-body').html("<p>Password length must be atleast 6</p>");
    $('.my-modal').modal('toggle');
    document.cookie = "error=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  }
}