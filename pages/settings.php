<!-- Make a settings page -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="../resources/Planet2.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@1,9..40,700&display=swap"
      rel="stylesheet"
    />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      type="module"
      src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script src="../resources/scripts/dashboard.js"></script>
    <link rel="stylesheet" href="../resources/styles/style.css" />
    <title>Planet</title>
  </head>
  <?php 
    session_start();
  ?>
  <body class="chenw21setting">
    <div class="chenw21navigation">
      <ul>
        <li class="chenw21logo">
          <img
            src="../resources/Planet2.png"
            alt="Planet Logo"
            id="athalm_logo"
          />
          <h1 id="planettitle">Planet</h1>
        </li>
        <li class="dash-greeting">
          <a href="./dashboard.php">
            <span class="icon">
              <ion-icon name="person-outline"></ion-icon>
            </span>
            <span class="title dash-name"><?php echo $_SESSION['user_name']?></span>
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
          <a href="../index.html">
            <span class="icon">
              <ion-icon name="log-out-outline"></ion-icon>
            </span>
            <span class="title">Sign Out</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="chenw21main">
      <div class="settingstitle">
        <h1>Settings</h1>
      </div>
      <div class="settingsmain">
        <div class="appearance">
          <div id="darkmodetext">
            <h2>Appearance</h2>
            <h5 id="settingsdescription">
              Customize how your planet looks on your device
            </h5>
          </div>
          <div id="darkmodebutton">
            <label class="switch">
              <input type="checkbox" />
              <span class="slider round"></span>
            </label>
          </div>
        </div>

        <div class="ChangePass">
          <hr />
          <a href="reset_password.html" id="PASS">
            <h3>Change Password</h3>
            <h5 id="settingsdescription">
              Set a permanent password for your account
            </h5>
          </a>
        </div>

        <div class="ChangeEmail">
          <hr />
          <a href="reset_email.html" id="EMAIL">
            <h3>Change Email</h3>
            <h5 id="settingsdescription">Change the email for your account</h5>
          </a>
        </div>

        <div class="DeleteAcc">
          <hr />
          <a href="delete_account.html" id="ACCOUNT">
            <h3>Delete Account</h3>
            <h5 id="settingsdescription">
              Permanently delete this account and remove all access
            </h5>
          </a>
        </div>
      </div>
    </div>
  </body>
</html>
