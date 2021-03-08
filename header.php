<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" type="text/css" href="style.css">
        <title></title>

  <!-- "index" failas padalintas per tris failus. Pradžia header.php, main dalis - index.php, footer'is - footer.php.       -->
    </head>
    <body>

      <header>
        <nav>
          <a href="#">
            <img src="images/logo.png" alt="Shop logo">
          </a>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
          <div class="">
            <!-- post metodas naudojamas, kai į db siunčiama pažeidžiama informacija. Taip informacija nesimato URL, atvirkščiai nei su GET. -->
            <!-- "nematomus" failus patogu laikyti atskirai su papildomu užvadinimu .inc, kad būtų aišku, kad tai neprieinamas failas. -->
            <?php
            if (isset($_SESSION['userId'])) {
                echo'<form action="includes/logout.inc.php" method="post">
                     <button type="submit" name="logout-submit">Logout</button>
                     </form>';
            }
            else {
                echo'<form action="includes/login.inc.php" method="post">
                     <input type="text" name="mailuid" placeholder="Username/ E-mail..">
                     <input type="password" name="pwd" placeholder="Password">
                     <button type="submit" name="login-submit">Login</button>
                     </form>
                     <a href="signup.php">Signup</a>';
            }
            ?>

          </div>
        </nav>

      </header>
