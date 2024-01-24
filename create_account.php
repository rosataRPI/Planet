<!-- although this is php its still lightweight becuase it reaches the user as an html form to work with the js -->
<!DOCTYPE html>
<html lang="en" onload="focusFirstCA()">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="../resources/Planet2.png" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="resources/styles/style.css" />
    <script src="resources/scripts/createAccount.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat" />
</head>

<body class="create_account_page">
<?php
    //check if previous credentials were invalid
    if((!empty($_GET["success"])) && $_GET["success"] == "false"){  
            echo "<script type='text/javascript'>alert('Account creation failed');</script>";
    }
    //check if previous account creation used username already in use
    if((!empty($_GET["exists"])) && $_GET["exists"] == "true"){
            echo "<script type='text/javascript'>alert('Account under this username already exists');</script>";
    }
    
?>    
            <div id="nav1">
                <a href="">
                    <img src="resources/Planet2.png" alt="Planet Logo" id="athalm_logo"/>
                </a>
                <h1 id="planettitle">Welcome to<br/>Planet</h1>
            </div>
            <div></div>
            <form id="sign_up" method="post" onsubmit="return validateCA()" action="newUser.php">
                     <h2 class="create_account">Create an Account</h2>
                     <div class="formData">
                        <label for="name">Name:</label>
                        <input type="text" placeholder="Enter your name" id="name" name="name" />

                        <label for="email">Email:</label>
                        <input type="email" autocomplete="email" placeholder="Enter your email" id="email" name="email"/>

                        <label for="phone">Phone number:</label>
                        <input type="tel" autocomplete="tel" placeholder="Enter your phone number" id="phone" name="phone"/>

                        <label for="password">Password:</label>
                        <input type="password" placeholder="Enter your password" id="password" oninput="checkPasswordStrength()" name="password"/>
                        <p id="pw-warning"></p>
                        
                        <label for="confirm_password">Confirm Password:</label>
                        <input type="password" placeholder="Re-enter your password" id="confirm_password" name="confirm_password"/>

                        
                        <label for="classyear">Class Year:</label>
                        <select id="classyear">
                            <option>Freshman</option>
                            <option>Sophomore</option>
                            <option>Junior</option>
                            <option>Senior</option>
                            <option>Graduate Student</option>
                        </select>
                        <div> 
                            <input type="reset" value="Clear" />
                            <input type="submit" value="Sign Up" id="save" name="save" />
                        </div>
                        
                    </div>
                  
            </form>
            
</div>
</body>

</html>

