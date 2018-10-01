<?php
// Include config file
require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if(empty($_POST["salutation"]))
$sal = "";
else
$sal= "\"".$_POST["salutation"]."\"";

if(empty($_POST["firstName"]))
$fName = "";
else
$fName= "\"".$_POST["firstName"]."\"";

if(empty($_POST["middleInitial"]))
$mInitial = "";
else
$mInitial="\"".$_POST["middleInitial"]."\"";

if(empty($_POST["lastName"]))
$lName = "";
else
$lName="\"".$_POST["lastName"]."\"";

if(empty($_POST["birthday"]))
$birth = "";
else
$birth="\"".$_POST["birthday"]."\"";

if(empty($_POST["city"]))
$city = "";
else
$city="\"".$_POST["city"]."\"";

if(empty($_POST["province"]))
$prov = "";
else
$prov="\"".$_POST["province"]."\"";

if(empty($_POST["houseNumber"]))
$houseNo = "";
else
$houseNo="\"".$_POST["houseNumber"]."\"";

if(empty($_POST["street"]))
$street = "";
else
$street="\"".$_POST["street"]."\"";

if(empty($_POST["village"]))
$vlg = "";
else
$vlg="\"".$_POST["village"]."\"";

if(empty($_POST["building"]))
$bldg = "";
else
$bldg="\"".$_POST["building"]."\"";

if(empty($_POST["companyName"]))
$coName = "";
else
$coName="\"".$_POST["companyName"]."\"";

if(empty($_POST["addressType"]))
$adType = "";
else
$adType="\"".$_POST["addressType"]."\"";

if(empty($_POST["landmark"]))
$lMark = "";
else
$lMark="\"".$_POST["landmark"]."\"";

if(empty($_POST["addressRemark"]))
$adRemark = "";
else
$adRemark="\"".$_POST["addressRemark"]."\"";

if(empty($_POST["mobileNumber"]))
$mobile = "";
else
$mobile="\"".$_POST["mobileNumber"]."\"";

if(empty($_POST["emailAddress"]))
$emAd = "";
else
$emAd="\"".$_POST["emailAddress"]."\"";

$debug ='2';
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
                    $username_err = "This username is already taken";
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
        $password_err = "Must have at least 6 characters";
    } else{
        $password = trim($_POST['password']);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = '   ';
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match';
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
                // Prepare an insert statement
                            $sql = "SELECT id FROM users where username=\"".$username."\"";
                            if($result = mysqli_query($link, $sql)){
                                if(mysqli_num_rows($result) > 0){
                                    $numrows=mysqli_num_rows($result);
                                    $row = mysqli_fetch_array($result);
                                    $userid=$row["id"];
                                    mysqli_free_result($result);
                                } else{
                                    $numrows=0;
                                    echo "No records matching your query were found.";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                            }
                                $sql = "INSERT INTO account (salutation, first_name, middle_initial, last_name, birthday, city, province,
                                house_number, street, village, building, company_name, address_type, landmark,
                                address_remark, mobile_number, email_address, users_id) VALUES ($sal, $fName, $mInitial, $lName, $birth, $city, $prov,
                                $houseNo, $street, $vlg, $bldg, $coName, $adType, $lMark, $adRemark, $mobile, $emAd, $userid)";
                                // // Validate fields
                                mysqli_query($link, $sql);
                                $debug=mysqli_error($link);
                                // Redirect to login page
                                header("location: login.php?state=1");
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
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>McDelivery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylesSignUp.css">
</head>

<body>

  <div class="wrapper">
	<div class="container">
		<img src="logo2.png" alt="logo">
		<h1>Please fill up the form.</h1>
		<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <span class="row">
            <input type="text" class="col-md-4" name="username" placeholder="<?php echo (!empty($username_err)) ? $username_err : 'Enter Username'; ?>">
			<input type="password" class="col-md-4" name="password" placeholder="<?php echo (!empty($password_err)) ? $password_err : 'Enter Password'; ?>">
			<input type="password" class="col-md-4" name="confirm_password" placeholder="<?php echo (!empty($confirm_password_err)) ? $confirm_password_err : 'Re-enter Password'; ?>">
            </span>
            <span class="row">
            <input type="text" class="col-md-1" name="salutation" placeholder="Salutation">
            <input type="text" class="col-md-5" name="firstName" placeholder="First Name">
            <input type="text" class="col-md-1" name="middleInitial" placeholder="M.I.">
            <input type="text" class="col-md-5" name="lastName" placeholder="Last Name">
            </span>
            <span class="row">
            <input type="date" class="col-md-3" name="birthday" placeholder="Birthdate">
            <input type="text" class="col-md-4" name="city" placeholder="City">
            <input type="text" class="col-md-5" name="province" placeholder="Province">
            </span>
            <span class="row">
            <input type="text" class="col-md-2" name="houseNumber" placeholder="House No.">
            <input type="text" class="col-md-5" name="street" placeholder="Street">
            <input type="text" class="col-md-5" name="village" placeholder="Village">
            </span>
            <span class="row">
            <input type="text" class="col-md-4" name="building" placeholder="Building">
            <input type="text" class="col-md-4" name="companyName" placeholder="Company Name">
            <input type="text" class="col-md-4" name="addressType" placeholder="Address Type">
            </span>
            <span class="row">
            <input type="text" class="col-md-5" name="landmark" placeholder="Landmark">
            <input type="text" class="col-md-7" name="addressRemark" placeholder="Address Remark">
            </span>
            <span class="row">
            <input type="number" class="col-md-5" name="mobileNumber" placeholder="Mobile Number">
            <input type="text" class="col-md-7" name="emailAddress" placeholder="Email Address">
            </span>
            <button type="submit" class="col-md-12" id="login-button">Sign Up</button>
		</form>
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<!-- <script src="js/index.js"></script> -->
</body>

</html>
