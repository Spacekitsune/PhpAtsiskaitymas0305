<?php
  include_once "header.php";
?>
    <main>

      <div class="">
        <section class="">
            <?php
            if (isset($_SESSION['userId'])) {
               echo'<p class="login-message">You are logged in!</p>';
               include 'items.php';

            }
            else {
                echo'<p class="login-message">You are logged out!</p>';
                echo'
                     <div class="login-container">
                        <form action="includes/login.inc.php" method="post">
                                <input type="text" name="mailuid" placeholder="Username/ E-mail..">
                                <input type="password" name="pwd" placeholder="Password">
                                <button type="submit" name="login-submit">Login</button>
                        </form>
                     </div>';
            }
            ?>
        </section>
      </div>

    </main>

<?php
    include_once "footer.php"
?>
