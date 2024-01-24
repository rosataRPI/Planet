function deleteAccount() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (confirm("Are you sure you want to delete your account?")) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    alert("Account deleted successfully");
                    window.location.href = "index.php";
                } else {
                    alert("Error deleting account. Please try again.");
                }
            }
        };

        xhr.open("POST", "delete_account.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("email=" + encodeURIComponent(email) + "&password=" + encodeURIComponent(password));
    }

    return false;
}
