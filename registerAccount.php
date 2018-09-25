<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "   ";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "   ";
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = '   ';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px;
                  padding: 20px;}
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

<body class="registration">

    <div class="wrapper">
        <h2 id="signup">Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <br>
          <div class = "usernameform">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
          </div>
            <br>
          <div class = "passwordform">
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
          </div>
            <br>
            <br>
        <div class = "confirmpasswordform">
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
          </div>
            <br>
        <div class= "loginbutton">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Sign up">
                <!-- <input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
          </div>
          <br>
          <br>
          <br>
            <p>Already have an account? <a href="login.php" id="loginlink">Login here</a>.</p>
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
