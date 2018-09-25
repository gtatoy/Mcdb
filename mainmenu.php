<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>mcdelivery</title>
  <link rel="stylesheet" href="styles.css"  type="text/css">
  <link rel="shortcut icon" href="mc-logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body class = "">
      <div class="bgcolor">
            <header class ="BackgroundColor">
                <div class="row">
                  <div class="logo">
                    <a href="menu.html"><img src="logo.png" alt="logo"></a>
                  </div>
                  <ul class="main-nav">
                    <li><a href="menu.php">MENU</a></li>
                    <li><a href="mybag.html">MY BAG</a></li>
                    <li><a href="myfavorites.html">MY FAVORITES</a></li>
                    <li><a href="ordertracker.html">ORDER TRACKER</a></li>
                    <li><a href="myaccount.html">MY ACCOUNT</a></li>
							      <li><a href="logout.php"><?php
                    session_start() ;
                    $name = $_SESSION['username'];
                    $name = strtoupper($name);
                    echo $name;
                    ?>
                  </a></li>
                  </ul>
                </div>
            </header>

            <h1></h1>

    </div>

    <div id="pic">
      <img src="new.png" alt="">
    </div>

        <div id="banner">
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
