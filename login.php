<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            // $_SESSION['accountID']=;
                            header("location: menu_burger.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mcdelivery</title>
  <link rel="stylesheet" type="text/css" href="style2.css" >
  <link rel="stylesheet" type="text/css" href="styles.css" >
  <link rel="shortcut icon" href="mc-logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
      body{
        font: 14px sans-serif; }
        .wrapper{
          position: relative;
          margin-left: 125%;
          margin-top: 50%;
          width: 300px;
          height: 300px;
          padding-left: 60px;
          padding-top: 30px;
          }
  </style>
</head>

<header class ="BackgroundColor">
    <div class="row">
      <div class="logo">
        <a href="menu.html"><img src="logo.png" alt="logo"></a>
      </div>
    </div>

</header>
</div>


<body  class="loginsystem">


    <div class="wrapper">
        <h2 id="signin">Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <br>
          <div class = "usernamelogin">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo '<br>'.$username_err; ?></span>
            </div>
          </div>
          <br>
          <div class = "passwordlogin">
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo '<br>'.$password_err; ?></span>
            </div>
          </div>
          <br>
          <div class= "loginbutton1">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
          </div>
          <br>
          <br>
          <br>
            <p>Don't have an account? <a href="registerAccount.php" id="loginlink">Sign up now</a>.</p>
        </form>
  </div>



    <div class="social_media">
      <div><a target="_blank" rel="noopener" href="https://www.facebook.com/McDo.ph/"><i class="fa fa-facebook-official fa-3x" aria-hidden="true"></i></a></div>
      <div><a target="_blank" rel="noopener" href="https://instagram.com/mcdo_ph/?hl=en"><i class="fa fa-instagram fa-3x"></i></a></div>
      <div><a target="_blank" rel="noopener" href="https://twitter.com/mcdo_ph"><i class="fa fa-twitter fa-3x" aria-hidden="true"></i></a></div>
    </div>
    <div class="footer">
      <div><a href="">ABOUT</a></div>
      <div><a href="">CHARITY</a></div>
      <div><a href="">CAREERS</a></div>
      <div><a href="">PRESS CENTRE</a></div>
      <div><a href="">GALLERY</a></div>
      <div><a href="">BUSINESS OPPORTUNITY</a></div>
      <div><a href="">CUSTOMER CARE</a></div>
      <div><a href="">NEWSLETTER</a></div>
      <div><a href="">TERMS AND CONDITION</a></div>
      <div><a href="">PRIVACY POLICY</a></div>
    </div>




</body>
</html>
