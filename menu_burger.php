<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "mcdb");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$numrows=0;
// Attempt select query execution
if(isset($_GET['category'])){

$category = $_GET['category'];
$category = str_replace('%20',' ',$category);

$sql = "SELECT * FROM item where category=\"".$category."\"";
}
else
  $sql = "SELECT * FROM item ";



if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){

        $numrows=mysqli_num_rows($result);
        for($i=0;$i<$numrows;$i++)

        {
          $row = mysqli_fetch_array($result);
            $arr1[]=$row["name"];
            $arr2[]=$row["price"];
            $arr3[]=$row["imageLink"];
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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>mcdelivery</title>
  <link rel="stylesheet" href="css/itemStyle.css"  type="text/css">
  <link rel="shortcut icon" href="Logos/mc-logo.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body>
      <div class="banner">
            <div class ="headerbar">
                <div class="row">
                  <div class="logo">
                    <a href="menu.php"><img src="Logos/logo.png" alt="logo"></a>
                  </div>


                  <ul class="mainNav">
                    <li><a href="logout.php"><?php
                          session_start();
                          $name = $_SESSION['username'];
                          $name = strtoupper($name);
                          echo $name;
                        ?>
                        </a>
                    </li>
                    <li><a href="myaccount.php">MY ACCOUNT</a></li>
                    <li><a href="ordertracker.php">ORDER TRACKER</a></li>
                    <li><a href="myfavorites.php">MY FAVORITES</a></li>
                    <li><a href="mybag.php">MY BAG</a></li>
                    <li><a href="menu.php">MENU</a>
                      <ul class="menuNav">
                        <li><a href="menu_burger.php?category=Burgers"                  > Burgers</a></li>
                        <li><a href="menu_burger.php?category=Chicken and Platter"      >Chicken and Platter</a></li>
                        <li><a href="menu_burger.php?category=Spicy Chicken Mcdo"       >Spicy Chicken McDo</a></li>
                        <li><a href="menu_burger.php?category=McSaver Meal"             >McSaver Meal</a></li>
                        <li><a href="menu_burger.php?category=Breakfast"                >Breakfast</a></li>
                        <li><a href="menu_burger.php?category=Fries \'N McFloat Combos" >Fries 'N McFloat Combos</a></li>
                        <li><a href="menu_burger.php?category=Desserte"                 >Desserts</a></li>
                        <li><a href="menu_burger.php?category=A la carte"               >A la carte</a></li>
                        <li><a href="menu_burger.php?category=Add Ons"                  >Add Ons</a></li>
                        <li><a href="menu_burger.php?category=Drinks"                   >Drinks</a></li>
                      </ul>
                    </li>


                  </ul>
                </div>
            </div>

    </div>




    <div class="listItems">
      <?php
          for($i=0;$i<$numrows;$i+=2){
                $j=$i+1;
                    if($j<$numrows){
                      echo "
                        <div class='rowItem'>
                          <div class='singleItem'> <img src= $arr3[$i] class='itemImage'> <div class='itemName'> $arr1[$i] </div> <div class='itemPrice'><br> Php$arr2[$i] <div class='orderButtonDiv'><a href='menu_burger.php'>ORDER</a></div> </div></div>
                          <div class='singleItem'> <img src= $arr3[$j] class='itemImage'> <div class='itemName'> $arr1[$j] </div> <div class='itemPrice'><br> Php$arr2[$j] <div class='orderButtonDiv'><a href='menu_burger.php'>ORDER</a></div> </div></div>
                        </div>";
                    }
                    else{
                      echo "
                        <div class='rowItem'>
                          <div class='singleItem'> <img src= $arr3[$i] class='itemImage'> <div class='itemName'> $arr1[$i] </div> <div class='itemPrice'><br> Php$arr2[$i] <div class='orderButtonDiv'><a href='menu_burger.php'>ORDER</a></div> </div></div>
                        </div>";
                    }
              }
      ?>
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
