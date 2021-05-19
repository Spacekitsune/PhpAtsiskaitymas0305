<?php

include_once "header.php";
require 'includes/dbh.inc.php';

$userId= $_SESSION['userId'];
$sql="SELECT * FROM items";

if (isset($_GET['cartdelete'])) {
    if ($_GET['cartdelete'] == "success") {
        echo "<h1>Jūsų krepšelis buvo ištrintas. Galite rinktis prekes.</h1>";
    }
}

echo "<table>";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database access failed: " . mysqli_error($conn));
}else {
    $rows = mysqli_num_rows($result);
    if ($rows) {
        while ($row= mysqli_fetch_assoc($result)) {
            echo "<form action='index.php?item=".$row["item_name"]."' method='POST'>
                    <tr>
                        <td>".$row['item_id']."</td>
                        <td>".$row['item_name']."</td>
                        <td>                       
                        <input type='submit' value='Prideti' name='addToCart'></td>
                    </tr>
                    </form>";
        }
    }
}
echo "</table>";

if (isset($_POST['addToCart'])) {
    $item=$_GET['item'];
    $sqlInsert ="INSERT INTO cart_userid (user_id, item) VALUES ( $userId, '$item')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "<p>Prekė ".$item." buvo pridėta į prekių krepšelį.</p>";
    } else {
        echo "Klaida: " . $sqlInsert . "<br>" . $conn->error;
    }
    echo "<a href='cart.php'>Baigti apsipirkimą</a>";
}





$conn->close();

include_once "footer.php";

