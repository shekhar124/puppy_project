<!-- connecting to data base -->

<?php
$hostName="localhost";
$dbuser="root";
$dppassword="";
$dbName="log_form";
mysqli_connect($hostName,$dbuser,$dppassword,$dbName);
if (!$conn) {
    die("some thing went wrong")
}
?>