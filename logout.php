<!-- // if we click on logout it will redirect to the login page -->
<?php
session_start();
session_destroy();
header("Location: login.php")
?>