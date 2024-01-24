<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="icon" type="image/svg+xml" href="../resources/Planet2.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@1,9..40,700&display=swap"
    rel="stylesheet" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="../resources/styles/style.css" />
  <script src="../resources/scripts/dashboard.js"></script>
  <title>Planet</title>
</head>

<body class="chenw21body">
<?php 
  session_start();  
  if(!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
  }
  $servername = "localhost";
  $username = "root";
  $password = "RPInets13";
  $dbname = "planet";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
?>
<script>
  console.log("<?php echo "Connected successfully";?>");
  document.cookie = "userid=<?php echo $_SESSION['user_id']?>" 
  function filter(assign_type) {
      window.location = `../pages/dashboard.php?filter_type=${assign_type}`;
  }
  //Prepend task form to the table
  function add_task() {
    $("#new-task").remove();
    $("#athalm_assignmentTableBody").prepend(`
    <tr id="new-task">
        <td><input id="name" name="name" form="add-task"/></td>
        <td><input id="due_date" name="due_date" form="add-task"/></td>
        <td><input id="type" name="type" form="add-task"/></td>
        <td><select name="status" id="status" form="add-task">
                <option value="To Do">To Do</option>
                <option value="Ongoing">Ongoing</option>
                <option value="Finished">Finished</option>
                <option value="Overdue">Overdue</option>
            </select>
        </td>
        <td><a class="chenw21btn" id="save-task">Save</a></td>
    </tr>
    `)
    $('#save-task').click(() => {
        $('#add-task').submit();
        console.log($('#status').val());
    });
    function signout() {
      <?php 
        //unset all session variables
        //$_SESSION = array();
        
      ?>
    }
  }
</script>
  <div class="chenw21container">
    <div class="chenw21navigation">
      <ul>
        <li class="chenw21logo">
          <img src="../resources/Planet2.png" alt="Planet Logo" id="athalm_logo" />
          <h1 id="planettitle">Planet</h1>
        </li>

        <li class="dash-greeting">
          <a href="./dashboard.php">
            <span class="icon">
              <ion-icon name="person-outline"></ion-icon>
            </span>
            <span class="title dash-name"><?php echo $_SESSION['user_name'];?></span>
          </a>
        </li>

        <li>
          <a href="./dashboard.php">
            <span class="icon">
              <ion-icon name="calendar-outline"></ion-icon>
            </span>
            <span class="title">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="./settings.php">
            <span class="icon">
              <ion-icon name="settings-outline"></ion-icon>
            </span>
            <span class="title">Settings</span>
          </a>
        </li>
        <li>
          <a href="../signout.php">
            <span class="icon">
              <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span class="title">Sign Out</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="chenw21main">
      <div class="chenw21searchbar">
        <div class="chenw21search">
          <form action="../pages/dashboard.php" method="GET">
            <input id="chenw21input" type="text" name="search" placeholder="Search here" />
          </form>
          <ion-icon name="search-outline"></ion-icon>
        </div>
      </div>
      <?php
        
        $todo = 0;
        $ongoing = 0;
        $finished = 0;
        $overdue = 0;
        //Display assignments
        function display_assign($filter = null) {
          $user_id = $_SESSION['user_id'];
          num_type();
          $str = file_get_contents("../assignments/$user_id-assignments.json");
          $data = json_decode($str, true);
          usort($data, function ($a, $b) {
            return strtotime($a['due_date']) <=> strtotime($b['due_date']);
          });
          $x = 0;
          foreach ($data as $assignment) {

            if ($filter != null) {
              if ($assignment["status"] != $filter) continue;
            } 
            echo "<tr>\n";
            echo "  <td> ". $assignment['name']. "</td>\n";
            echo "  <td> ". $assignment["due_date"] . "</td>\n";
            echo "  <td> ". $assignment["type"] . "</td>\n";
            echo "  <td id="a-$x" onclick=""> <span class='chenw21status " . preg_replace('/\s+/', '', $assignment["status"]). "'>" . $assignment["status"] ."</span></td>\n";
            echo "</tr>\n";
            $x += 1;
          }
          
          
        }
        //Count number of each type
        function num_type () {
          $GLOBALS["todo"] = 0; 
          $GLOBALS["ongoing"] = 0; 
          $GLOBALS["finished"] = 0; 
          $GLOBALS["overdue"] = 0; 
          $user_id = $_SESSION['user_id'];
          $str = file_get_contents("../assignments/$user_id-assignments.json");
          $data = json_decode($str, true);
          
          foreach ($data as $assignment) {
            if (strcmp($assignment["status"], "To Do") == 0) {
              $GLOBALS["todo"] += 1; 
            } else if (strcmp($assignment["status"], "Ongoing") == 0) {
              $GLOBALS["ongoing"] += 1; 
            } else if (strcmp($assignment["status"], "Finished") == 0) {
              $GLOBALS["finished"] += 1; 
            } else if (strcmp($assignment["status"], "Overdue") == 0) {
              $GLOBALS["overdue"] += 1; 
            }
          }
        }
        //Filter by
        function filterby($filter) {
          
        }
        num_type();
      ?>
      <div class="chenw21cardBox">
        <div class="chenw21card" onclick='filter("To Do")'>
          <div>
            <div class="chenw21numbers"><?php echo $todo; ?></div>
            <div class="chenw21cardName">To Dos</div>
        
          </div>

          <div class="chenw21iconBox">
            <ion-icon name="clipboard-outline"></ion-icon>
          </div>
        </div>

        <div class="chenw21card" onclick='filter("Ongoing")'>
          <div>
            <div class="chenw21numbers"><?php echo $ongoing; ?></div>
            <div class="chenw21cardName">In Progress</div>
          </div>

          <div class="chenw21iconBox">
            <ion-icon name="file-tray-stacked-outline"></ion-icon>
          </div>
        </div>

        <div class="chenw21card" onclick='filter("Finished")'>
          <div>
            <div class="chenw21numbers"><?php echo $GLOBALS["finished"]; ?></div>
            <div class="chenw21cardName">Finished</div>
          </div>

          <div class="chenw21iconBox">
            <ion-icon name="checkmark-done-outline"></ion-icon>
          </div>
        </div>
        <div class="chenw21card" onclick='filter("Overdue")'>
          <div>
            <div class="chenw21numbers"><?php echo $GLOBALS["overdue"]; ?></div>
            <div class="chenw21cardName">Overdue</div>
          </div>
          <div class="chenw21iconBox">
            <ion-icon name="close-outline"></ion-icon>
          </div>
        </div>
      </div>

      <div class="chenw21details">
        <div class="chenw21AllTasks">
          <div class="chenw21Taskheader">
            <div class="chenw21tasksadd">
              <h2>Tasks</h2>
              <a href="#" class="chenw21addnew" onclick="add_task()"> + Add New Task</a>
            </div>
            <a href="../pages/dashboard.php" class="chenw21btn">View All</a>
          </div>
          <form id="add-task" method="post" action="../new_assignment.php"></form>
          <table>
            <thead>
              <tr>
                <td id="athalm_name_header" onclick="sort_assignments('name');"><a href="#" id="athalm_a_name">Name</a></td>
                <td id="athalm_duedate_header" onclick="sort_assignments('date');"><a href="#" id="athalm_a_duedate"> Due On</a></td>
                <td id="athalm_type_header" onclick="sort_assignments('type');"><a href="#" id="athalm_a_type"> Type</a></td>
                <td id="athalm_status_header" onclick="sort_assignments('status');"><a href="#" id="athalm_a_status"> Status</a></td>
              </tr>
            </thead>

            <tbody id="athalm_assignmentTableBody">
              <?php 
              //Code for search function
              if (isset($_GET["search"])) {
                $search = $_GET["search"];
                $userid = $_SESSION['user_id'];
                if (!empty($search)) {
                    echo "<b>Searching for ". $search. "</b>";   
                    $search = $conn->real_escape_string($search);
                    $sql = "SELECT 
                                assign_name, 
                                due_date,
                                assign_type,
                                assign_status
                            FROM users u JOIN
                                JSON_TABLE (
                                    u.assignments,
                                    '$[*]' COLUMNS (
                                        assign_name VARCHAR(30) PATH '$.name' ERROR ON ERROR,
                                        due_date VARCHAR(20) PATH '$.due_date' ERROR ON ERROR,
                                        assign_type VARCHAR(40) PATH '$.type' ERROR ON ERROR,
                                        assign_status VARCHAR(20) PATH '$.status' ERROR ON ERROR
                                    )
                                ) AS t
                              WHERE id = $userid;"; 
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        if (levenshtein($search, $row["assign_name"], 1, 4, 1) < 6 ) {
                          echo "<tr>\n";
                          echo "  <td> ". $row['assign_name']. "</td>\n";
                          echo "  <td> ". $row["due_date"] . "</td>\n";
                          echo "  <td> ". $row["assign_type"] . "</td>\n";
                          echo "  <td> <span class='chenw21status " . preg_replace('/\s+/', '', $row["assign_status"]). "'>" . $row["assign_status"] ."</span></td>\n";
                          echo "</tr>\n";
                        }
                    }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                } else {
                    echo "Please enter something to search";
                }
              } else {
                if(isset($_GET['filter_type'])) {
                  display_assign($_GET['filter_type']);
                } else {
                  display_assign();
                }
                
              }
              
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>


</html>