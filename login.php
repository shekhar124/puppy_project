<?php
session_start();
print_r($_SESSION);
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login form</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    

</head>
<body>
    <?php
    if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password =$_POST["password"];
        require_once "database.php";
        $sql = "SELECT * FRoM where email = '$email'";
        $result =mysqli_query($conn , $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user){
            if(password_verfy($password , $user["password"])){
                session_start();
                $_SESSION["user"]="yes";
                header("Location: index.php");

            }else{
                echo"<div class='alert alert-danger'> pswrd does not match</div>";
            }

        }else{
            echo"<div class='alert alert-danger'> Email does not match</div>";
        }
    }
    
    ?>
    <div class="container">
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" name="email" placeholder="enter email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password"name="password" placeholder="enter passwd" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="login" class="btn btn-primary">
            </div>
        </form>
    </div>
    <div>
        <p>Not regestered <a href="reg.php">click here to register</a></p>
    </div>
</body>
</html>