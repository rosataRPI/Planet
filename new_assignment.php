<!-- php code for storing assignment json into mysql -->
<?php
    session_start();
    //validate for if javascript is disabled in users browser 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_assignment = array(
            "name" => $_POST['name'],
            "due_date" => $_POST['due_date'],
            "type" => $_POST['type'],
            "status" => $_POST['status']
        );
        $user_id = $_SESSION['user_id'];
        $assignments = file_get_contents("assignments/$user_id-assignments.json");
        $data = json_decode($assignments, true);
        array_push($data, $new_assignment);
        file_put_contents("assignments/$user_id-assignments.json", json_encode($data));
        
    }
    $new_json = json_encode($data);
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
    //check if username already in users table
    $result = $conn -> query("UPDATE users SET assignments = '{$new_json}' WHERE id ='{$_SESSION['user_id']}';");
    if($result === TRUE){
        echo "Record updates";
        $conn->close();
        header("Location: pages/dashboard.php");
    } else {
        echo "Failure to add assignment <br> " . $conn->error;
    }
    echo " -- prexisting check complete --";

    $conn->close();
        
?>
