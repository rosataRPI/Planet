<!-- php document for login.php -->
<?php
    session_start();
    //validate login credentials
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!(empty($_POST['email']))){
            $clean_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if($clean_email){
                $email = filter_var($clean_email, FILTER_VALIDATE_EMAIL);
                if($email == false){
                    echo "Email is not valid";
                    header("Location: login.php?exists=false");
                }
            }
            else{
                echo "Email is not valid";
                header("Location: login.php?exists=false");
            }  
        }
        else{
            echo "Email is required";
            header("Location: login.php?exists=false");
        } 
    
        if(!(empty($_POST['password']))){
            $clean_pass = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
            if($clean_pass){
                //password will be validated when checked with db since its subjetive what a valid password is
                //once its sanitized we just check if it matches the pass in the db thats all that were concerned about 
                $pass = $clean_pass;
            }
            else{
                echo "Password is not valid";
                header("Location: login.php?exists=false");
            }  
        }
        else{
            echo "Password is required";
            header("Location: login.php?exists=false");
        }  
        
        $pass = $_POST['password'];
    }
    
    //check for authentication
   $servername = "localhost";
   $username = "root";
   $password = "RPInets13";
   $dbname = "planet";
   
   // Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
   //Connection error check
   if ($conn->connect_error) {
       echo ("Connection failed: " . $conn->connect_error);
   } 
   print "mysql not the 500";
    //fetch row that contains email
    $result = $conn -> query("SELECT * FROM users WHERE email='{$email}';");
    if($result -> num_rows == 0){
        echo "No account associated with email";
        header("Location: login.php?exists=true");
    }
    //retreive password from row 
    // $tester = (($result->fetch_assoc())['password']);
    $assoc = ($result->fetch_assoc());
    $tester = $assoc['password'];
    if(strcmp(trim($pass), trim($tester)) == 0){
        echo "Credentials authenticated";

        //pull json for user and send in session cookie
        $userJson = $assoc['assignments'];
        $_SESSION['user_name'] = $assoc['name'];
        $_SESSION['user_id'] = $assoc['id'];
        $user_id = $assoc['id'];
        file_put_contents("assignments/$user_id-assignments.json", $userJson);
        header("Location: pages/dashboard.php");
    }
    else{
        echo "Incorrect password";
        header("Location: login.php?success=false");
    }

?>