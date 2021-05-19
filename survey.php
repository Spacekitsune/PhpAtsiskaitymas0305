<?php
include_once "header.php";

if (isset($_SESSION['userId'])) {
    echo'<p class="login-message">You are logged in!</p>';
    echo "<h1>Klientų apklausa</h1>
    <form action='' method='POST'>
        <p>Ar esate patenkinti prekių pristatymu?</p>
        1 <input type='radio' name='q1' value='1'/>
        2 <input type='radio' name='q1' value='2'/>
        3 <input type='radio' name='q1' value='3'/>
        4 <input type='radio' name='q1' value='4'/>
        5 <input type='radio' name='q1' value='5'/>
        <p>Ar kurjeris laikosi bendrų saugumo gairių?</p>
        1 <input type='radio' name='q2' value='1'/>
        2 <input type='radio' name='q2' value='2'/>
        3 <input type='radio' name='q2' value='3'/>
        4 <input type='radio' name='q2' value='4'/>
        5 <input type='radio' name='q2' value='5'/>
        <p>Ar pristatomos prekės atitinka informaciją pateikta puslapyje?</p>
        1 <input type='radio' name='q3' value='1'/>
        2 <input type='radio' name='q3' value='2'/>
        3 <input type='radio' name='q3' value='3'/>
        4 <input type='radio' name='q3' value='4'/>
        5 <input type='radio' name='q3' value='5'/> 
        <p>Ar esate patenkinti prekių komplektacija?</p>
        1 <input type='radio' name='q4' value='1'/>
        2 <input type='radio' name='q4' value='2'/>
        3 <input type='radio' name='q4' value='3'/>
        4 <input type='radio' name='q4' value='4'/>
        5 <input type='radio' name='q4' value='5'/>
        <p>Ar jums užtenka puslapyje pateikiamos informacijos?</p>
        1 <input type='radio' name='q5' value='1'/>
        2 <input type='radio' name='q5' value='2'/>
        3 <input type='radio' name='q5' value='3'/>
        4 <input type='radio' name='q5' value='4'/>
        5 <input type='radio' name='q5' value='5'/>
         <input type='submit' value='submit' name='submit' style='display: block'/>
    </form>
    <br>";
    $q1 = filter_input(INPUT_POST, 'q1');
    $q2 = filter_input(INPUT_POST, 'q2');
    $q3 = filter_input(INPUT_POST, 'q3');
    $q4 = filter_input(INPUT_POST, 'q4');
    $q5 = filter_input(INPUT_POST, 'q5');
    $apklausosVidurkis = ($q1+$q2+$q3+$q4+$q5)/5;

    if (filter_input(INPUT_POST, 'submit')) {
        echo "Jūsų įvertinimas: ".$apklausosVidurkis." balai"."<br>";
        echo "<br>";


        require 'includes/dbh.inc.php';
        $userId= $_SESSION['userId'];

        $sql ="INSERT INTO rating (user_id, average) VALUES ($userId, $apklausosVidurkis)";

        if ($conn->query($sql) === TRUE) {
            echo "<a href='index.php'>Grįžti atgal į prekių sąrašą</a>";
        } else {
            echo "Klaida: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

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

include_once "footer.php"
?>