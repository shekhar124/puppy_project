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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["submit"])){
        $fullName=$_POST["fullname"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $re_password=$_POST["re-password"];
        $passwordHash=password_hash($password, PASSWORD_DEFAULT);
        $errors = array();
        if(empty($fullName) OR empty($email) OR empty($password)OR empty($re_password)){
            array_push($errors,"All fields are required");
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($errors,"Email is not valid");
        }
        if(strlen($password)<8){
            array_push($errors,"pas should be more than 8");
        }
        if ($password!==$re_password) {
            array_push($errors,"Password not mached");
            
        }
    if (count($errors)>0) {
        foreach($errors as $errors){
            echo "<div class= 'alert alert-danger'>$error</div>";
        }
    }else{
        require_once "database.php";
        $sql = "insert into users(fullname , email ,password) values(?,?,?)";
       $stmt = mysqli_stmt_into($conn);
       $prepareStmt = mysqli_stmt_perpare($stmt,$sql);
       if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt,'sss',$fullName,$email,$passwordHash);
        mysqli_stmt_execute($stmt);
        echo "<div class='alert alert-sucess'>yor are good .</div>";
       }else{
        die("some thing went wrong")
       
    
    
       }}}
        ?>

        <form action="reg.php" method="post">
            <div class="form-group">
                <input type="text" class="form-container" name="fullname" placeholder="fullname">
            </div>
            <div class="form-group">
                <input type="email" class="form-container" name="email" placeholder="email">
            </div>
            <div class="form-group">
                <input type="password"class="form-container" name="password" placeholder="passwd">
            </div>
            <div class="form-group">
                <input type="password"class="form-container" name="re-password" placeholder="password">
            </div>
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Registration" name="submit">
            </div>
        </form>
    </div>
    <div><p>Alrdy regestered <a href="login.php">Login here</a></p></div>
</body>
</html>