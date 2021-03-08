<?php

//kintamieji su prisijungimu prie localhost
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";

//kintamasis reiškiantis prijungimą
$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

//tikrinam ar prisijungimas veikia, jei neveikia išmeta tikslią žinutę kodėl.
if (!$conn) {
   die("Connection failed: ".mysqli_connect_error());
}
