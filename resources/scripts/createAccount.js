// JS validation for create_account.html
// JS validation allows lightweight client side form validation that doesnt require server loading 
//response to determine whether inputs work however the less speedy server side validation is the actual
//security measure since users can disable js etc 
function validateCA() {
   check = false;
   alertT = "";
   focused = false;
   if (document.forms["sign_up"]["name"].value == "") {
      alertT += ("Please enter your name");
      check = true;
      if (focused == false) {
         focused = true;
         document.forms["sign_up"]["name"].focus();
      }
   }
   else if (document.forms["sign_up"]["email"].value == "") {
      alertT += ("Please enter your email");
      check = true;
      if (focused == false) {
         focused = true;
         document.forms["sign_up"]["email"].focus();
      }
   }
   else if (document.forms["sign_up"]["phone"].value == "") {
      alertT += ("Please enter your phone number");
      check = true;
      if (focused == false) {
         focused = true;
         document.forms["sign_up"]["phone"].focus();
      }
   }
   else if (document.forms["sign_up"]["password"].value == "") {
      alertT += ("Please enter your password");
      check = true;
      if (focused == false) {
         focused = true;
         document.forms["sign_up"]["password"].focus();
      }
   }
   else if (document.forms["sign_up"]["confirm_password"].value == "") {
      alertT += ("Please retype your password in the confirm password field");
      check = true;
      if (focused == false) {
         focused = true;
         document.forms["sign_up"]["confirm_password"].focus();
      }
   }
   else if (document.forms["sign_up"]["password"].value != document.forms["sign_up"]["confirm_password"].value) {
      alertT += ("Passwords must match");
      check = true;
      if (focused == false) {
         focused = true;
         document.forms["sign_up"]["password"].focus();
      }
   }
   if (check) {
      alert(alertT);
      return false;
   }

   document.cookie = document.forms["sign_up"]["name"].value;
   return true;
}

//Password Strength Validation
function checkPasswordStrength() {
   let password = document.getElementById('password').value;
   let strength = ['Password cannot be blank', 'Very weak', 'Weak', 'Medium', 'Strong', 'Very strong'];
   let score = 1;
   let warning = document.getElementById('pw-warning');

   if (password.length === 0) {
       document.getElementById('msg').innerHTML = strength[0];
       return;
   }

   if (/[a-z]/.test(password)) {
       score++;
   }

   if (/[A-Z]/.test(password)) {
       score++;
   }

   if (/[0-9]/.test(password)) {
       score++;
   }

   if (/[^a-zA-Z0-9]/.test(password)) {
       score++;
   }

   if (password.length < 8) {
       score--;
   } else if (password.length > 16) {
      score++;
   }

   warning.innerHTML = strength[score];

   if (score > 3) {
      warning.style.color = "green";
   } else {
      warning.style.color = "red";
   }
}

function focusFirstCA() {
   var element = document.getElementById("name");
   element.focus();
   
}

window.addEventListener("load", focusFirstCA);
