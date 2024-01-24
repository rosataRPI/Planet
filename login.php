<!DOCTYPE html>
<html onload="focusFirstLogin()">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="../resources/Logo.PNG" />
    <title>Sign In</title>
    <link rel="stylesheet" href="resources/styles/style.css">
    <script src="resources/scripts/login.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
</head>

<body class="holohf_body">
<?php
    //check if previous credentials were invalid
    if(!(empty($_GET["exists"])) && $_GET["exsist"] == "false"){  
            echo "<script type='text/javascript'>alert('Invalid email or password');</script>";
            echo "error1";
    }
    //check if email was found in users database
    else if (!(empty($_GET["exists"])) && $_GET["exsist"] == "true"){
        echo "<script type='text/javascript'>alert('Email not associated with an account');</script>";
        echo "error2";
    }
    //check if password is incorrect
    if(!(empty($_GET["success"])) && $_GET["success"] == "false"){  
        echo "<script type='text/javascript'>alert('Incorrect password');</script>";
        echo "error3";
    }
?>
<div id="nav1">
                <a href="">
                    <img src="resources/Planet2.png" alt="Planet Logo" id="athalm_logo"/>
                </a>
                <h1 id="planettitle">Welcome to<br/>Planet</h1>
            </div>

  
    <form id="sign_in" method="post" onsubmit="return validateLogin()" action="../Planet/authenticate.php">
            <h2 class="log_in">Log In</h2>
            <div class="formData">
                <label for="email">Email:</label>
                <input type="email" autocomplete="email" placeholder="Enter your email" id="email" name="email">

                <label for="password">Password:</label>
                <input type="password" placeholder="Enter your password" id="password" name="password">
                <div id="">
                    <a href="./forgot_password.html" id="forgot_pwd">Forgot Password?</a>
                </div>
                <div id="button">
                    <input type="reset" value="Cancel">
                    <input type="submit" value="Sign In" id="save" name="save">
                    
                </div>
            </div>
            </div>

    </form>



    </form>
</body>

</html>