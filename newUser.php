<!-- php document for create_account.php -->
<?php
    
    //validate for if javascript is disabled in users browser 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!(empty($_POST['name']))){
            $clean_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            if(!(empty($clean_name))){
                //once sanitized no need to validate name since its just a cleaned string which like password, cant really be invalid 
                $name = $clean_name;
            }
            else{
                echo "Name is not valid";
                header("Location: create_account.php?success=false");
            }  
        }
        else{
            echo "Name is required";
            header("Location: create_account.php?success=false");
        }
       
        if(!(empty($_POST['email']))){
            $clean_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if(!(empty($clean_email))){
                $email = filter_var($clean_email, FILTER_VALIDATE_EMAIL);
                if($email == false){
                    echo "Email is not valid";
                    header("Location: create_account.php?success=false");
                }
            }
            else{
                echo "Email is not valid";
                header("Location: create_account.php?success=false");
            }  
        }
        else{
            echo "Email is required";
            header("Location: create_account.php?success=false");
        }

        if(!(empty($_POST['phone']))){
            $clean_phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            if(!(empty($clean_phone))){
                $phone = filter_var($clean_phone, FILTER_VALIDATE_INT, ['options' => ['min_range' => 2012010000, 'max_range' => 9999999999]]);
                if($phone == false){
                    echo "Phone number must be 10 digit integer";
                    header("Location: create_account.php?success=false");
                }
                else{
                    $phone = strval($phone);
                }
            }
            else{
                echo "Phone number is not valid";
                header("Location: create_account.php?success=false");
            }  
        }
        else{
            echo "Phone number is required";
            header("Location: create_account.php?success=false");
        }
        echo "phone validated";

        if(!(empty($_POST['password']))){
            $clean_pass = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            if($clean_pass){
                //password will be validated when checked with db since its subjetive what a valid password is
                //once its sanitized we just check if it matches the pass in the db thats all that were concerned about 
                $pass = strval($clean_pass);
            }
            else{
                echo "Password is not valid";
                header("Location: login.php?exists=false");
            }  
            echo "inner band";
        }
        else{
            echo "Password is required";
            header("Location: login.php?exists=false");
        }
        //confirm passwords match
        if($_POST['password'] != $_POST['confirm_password']){
            echo "Passwords must match";
            header("Location: create_account.php?success=false");
        }        
    }
    
    // End of validation 

    $servername = "localhost";
    $username = "root";
    $password = "RPInets13";
    $dbname = "planet";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "connection sucessful";
    // check if username already in users table
    $result = $conn -> query("SELECT * FROM users WHERE email='{$email}';");
    if($result -> num_rows > 0){
        echo "Account with this username already exists";
        $conn->close();
        header("Location: create_account.php?exists=true");
    }
    echo " -- prexisting check complete --";

    //user doesnt already exist, so add to table 
    // empty json array 
    $json = '[]';
    $check = $conn -> query("INSERT INTO users (email, password, name, phone, assignments) 
         VALUES ('$email', '$pass', '$name', '$phone', '$json')");
    if ($check == TRUE) {
        echo "New account created successfully";
        header("Location: login.php?");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header("Location: create_account.php?success=false");
    }

    $conn->close();
        
?>
