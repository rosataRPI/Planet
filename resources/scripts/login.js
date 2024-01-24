// JS validation for login.html
function validateLogin() {
    check = false;
    alertT = "";
    focused = false;
    if (document.forms["sign_in"]["email"].value == "") {
        alertT += ("Please enter the email associated with your account");
        check = true;
        if (focused == false) {
            focused = true;
            document.forms["sign_in"]["email"].focus();
        }
    }
    else if (document.forms["sign_in"]["password"].value == "") {
        alertT += ("Password doesnt match email or account does not exist");
        check = true;
        if (focused == false) {
            focused = true;
            document.forms["sign_in"]["password"].focus();
        }
    }
    if (check) {
        alert(alertT);
        return false;
    }
    return true;
}

function focusFirstLogin() {
    var element = document.getElementById("email");
    element.focus();
}

window.addEventListener("load", focusFirstLogin);


