<?php
include_once "header.php";

echo "<h1>Jūsų pirkinių krepšelis</h1>";

require 'includes/dbh.inc.php';

$style="";

$userId= $_SESSION['userId'];
$sql="SELECT item, (SELECT COUNT(item)) AS pcs FROM cart_userid WHERE user_id=$userId GROUP BY item";


$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database access failed: " . mysqli_error($conn));
}else {

    $rows = mysqli_num_rows($result);
    if ($rows) {
        echo "<table id='table' style='display: block'>
<tr>
<th>Prekė</th>
<th>Kiekis</th>
</tr>";
        while ($row= mysqli_fetch_assoc($result)) {
            echo "
                    <tr>
                        <td>".$row['item']."</td>
                        <td>".$row['pcs']."</td>
                        </tr>
                    ";
        }
    }
}
echo "</table>
<form action='' method='POST'>
<input type='submit' value='Valyti krepšelį' name='deleteCart'>
</form>";

if (isset($_POST['deleteCart'])) {

    $sqlDelete ="DELETE FROM cart_userid WHERE user_id=$userId;";

    if ($conn->query($sqlDelete) === TRUE) {
        header("Location: index.php?cartdelete=success");

    } else {
        echo "Klaida: " . $sqlDelete . "<br>" . $conn->error;
    }
    echo "<a href='index.php'>Grįžti atgal į prekių sąrašą</a>";
}

include_once "footer.php";



