<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "mcdb");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$itemID = $_GET['itemid'];

$sql = "SELECT * FROM item where item_id=".$itemID;



if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        $numrows=mysqli_num_rows($result);
        for($i=0;$i<$numrows;$i++)

        {
          $row = mysqli_fetch_array($result);
            $arr1=$row["name"];
            $arr2=$row["price"];
            $arr3=$row["imageLink"];
            $arr4=$row["item_id"];
        }


        //echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        $numrows=0;
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Close connection
mysqli_close($link);
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="newstyle.css">
    <title></title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>
  <body>

      <nav id="mainNav">

        <ul>
              <div class="logo" ><div><img src="Logos/logo.png" alt="dog"></div></div>
          <li><a href="#">Menu</a>
            <ul class="subMenu">
              <li><a href="menu.php?category=Burgers"                  > Burgers</a></li>
              <li><a href="menu.php?category=Chicken and Platter"      >Chicken and Platter</a></li>
              <li><a href="menu.php?category=Spicy Chicken Mcdo"       >Spicy Chicken McDo</a></li>
              <li><a href="menu.php?category=McSaver Meals"            >McSaver Meals</a></li>
              <li><a href="menu.php?category=Breakfast"                >Breakfast</a></li>
              <li><a href="menu.php?category=Fries 'N McFloat Combos"  >Fries 'N McFloat Combos</a></li>
              <li><a href="menu.php?category=Desserts"                 >Desserts</a></li>
              <li><a href="menu.php?category=A la carte"               >A la carte</a></li>
              <li><a href="menu.php?category=Add Ons"                  >Add Ons</a></li>
              <li><a href="menu.php?category=Drinks"                   >Drinks</a></li>
            </ul>
          </li>

          <li><a href="#">My Bag</a></li>
          <li><a href="#">My Favorites</a></li>
          <li><a href="#">Order Tracker</a></li>
          <li><a href="#">My Account</a></li>
          <li><a href="logout.php"><?php
                session_start();
                $name = $_SESSION['username'];
                $name = strtoupper($name);
                echo $name;
              ?>
              </a>
          </li>


        </ul>
      </nav>


      <p><?php echo $category ?></p>
      <div class="purchaseWrapper">
        <img src="<?php echo $arr3 ?>" alt="item Image">
        <p><?php echo $arr1 ?></p>
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
