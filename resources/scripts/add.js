// JS validation for add_assignment.html
function validateAdd(formObj) {
    check = false;
    alertT = "";
    focused = false;
    if (formObj.name.value == "") {
        alertT += ("Please enter assignment name");
        check = true;
        if (focused == false) {
            focused = true;
            formObj.name.focus();
        }
    }
    else if (formObj.class.value == "") {
        alertT += ("Please enter class or general variety of assignment");
        check = true;
        if (focused == false) {
            focused = true;
            formObj.class.focus();
        }
    }
    else if (formObj.due_date.value == "" && formObj.type.value != "To Do (No due date)") {
        alertT += ("Please enter due date for assignment");
        check = true;
        if (focused == false) {
            focused = true;
            formObj.class.focus();
        }
    }
    if (check) {
        alert(alertT);
        return false;
    }
    alert("Assignment added!");
    // Proceed to add assignment
    return true;
}

function focusFirstAdd() {
    var element = document.getElementById("name");
    element.focus();
}

window.addEventListener("load", focusFirstAdd);
//  Prevent page from refreshing upon form validation so assignment can be added server side
window.addEventListener("submit", (e) => { e.preventDefault(); })