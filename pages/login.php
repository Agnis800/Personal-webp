<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body>
        <main>
          <div class="container">
            <?php
            if (isset($_POST["login"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                 require_once "database.php";
                 $sql = "SELECT * FROM users WHERE username = '$username'";
                 $result = mysqli_query($conn, $sql);
                 $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                 if ($user) {
                     if (password_verify($password, $user["password"])) {
                         session_start();
                         $_SESSION["user"] = "yes";
                         header("Location: merch.php");
                         die();
                     }else{
                        echo "<div class>='alert alert-danger'>Password does not match</div>";
                     }
                 }else{
                     echo "<div class>='alert alert-danger'>Username does not match</div>";
                 }
            }
            ?>
             <form action="login.php" method="post" style="border:1px solid #ccc">
                <h1>Login</h1>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" required>

                <div class="form-btn">
                    <input type="submit" value="Login" name="login" class="btn btn-primary">
                </div>
            </form>
            <div><p>Not registered yet <a href="register.php">Register Here</a></p></div>
         </div>
        </main>
    </body>
</html>