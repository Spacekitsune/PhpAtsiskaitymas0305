<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:wght@400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Parduotuvė</title>

  <!-- "index" failas padalintas per tris failus. Pradžia header.php, main dalis - index.php, footer'is - footer.php.       -->
    </head>
    <body>

      <header>
        <nav class="header-wrapper">
          <a href="#">
            <img class="logo-img" src="images/logo.png" alt="Shop logo">
          </a>
            <div >
            <ul class="menu-list">
            <li><a href="index.php">Shop</a></li>
            <li><a href="survey.php">Survey</a></li>
          </ul>

            <!-- post metodas naudojamas, kai į db siunčiama pažeidžiama informacija. Taip informacija nesimato URL, atvirkščiai nei su GET. -->
            <!-- "nematomus" failus patogu laikyti atskirai su papildomu užvadinimu .inc, kad būtų aišku, kad tai neprieinamas failas. -->
            <?php
            if (isset($_SESSION['userId'])) {
                echo'<form class="signup-logout" action="includes/logout.inc.php" method="post">
                     <button class="button-small" type="submit" name="logout-submit">Logout</button>
                     </form>';
            }
            else {
                echo'<a class="signup-logout"  href="signup.php">Signup</a>';
            }
            ?>

          </div>

        </nav>

      </header>
