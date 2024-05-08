<?php
session_start();
error_reporting(0);

require "partials/_dbConnect.php";
require "partials/_regularExp.php";

if (isset($_SESSION['userEmail'])) {
    header("location: index.php");
}

if (isset($_POST['forget'])) {

    $user_email = trim($_POST['email']);
    $user_pass = trim($_POST['password']);
    if (preg_match(passwordPattern, $user_pass)) {
        $sql = $conn->prepare("UPDATE `user` SET `user_password`=? WHERE `user_email`=?");
        $pass = md5($user_pass);
        $sql->bind_param("ss", $pass, $user_email);
        $res = $sql->execute();
        if ($res) {
            echo "<script>alert('Password updated successfully..!');
            location.href='_userLogin.php';</script>";
        } else {
            echo "<script>alert('Sorry,password could not updated..!');</script>";
        }
        $sql->close();
        $conn->close();
    } else {
        echo "<script>alert('!Password length min 5 and max 20 char,must contains 0-9,a-z,A-Z,!,@,#,%,^');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Forget</title>
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <!---- Responsive CSS file --->
    <link rel="stylesheet" href="./css/media.css">
    <!-- Favicon added -->
    <link rel="shortcut icon" href="img/original_logo.png" type="image/x-icon">
</head>

<body>
    <!-- User navbar included -->
    <?php require "_userNavbar.php"; ?>

    <!-- Login container start -->
    <div class="pad-x" id="login-container">
        <div class="page-title">
            <h1 class="heading">mayi<span class="highlight">help</span>you.io</h1>
        </div>
        <div class="form-box">
            <h3>Forget Password</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                <div class="form-element">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" type="email" name="email" id="email"
                        value="<?php if (isset($_POST['forget'])) echo $user_email; ?>" placeholder="E-mail" required />
                </div>
                <div class="form-element">
                    <label class="form-label" for="password">New Password</label>
                    <input class="form-input" type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-element">
                    <input class="form-input button submit-btn" type="submit" value="Forget" name="forget" id="login">
                    <div>
                        <a href="_userLogin.php" class="forgot-pass">Login</a>
                    </div>
                </div>
            </form>
            <hr class="form-line">
            <div class="sign-link">
                <span>Do not have an account?</span>
                <a href="_userRegistration.php">Sign-up</a>
            </div>

        </div>
    </div>
    <!-- Forget container End -->

    <!-- Javascript Files -->
    <script src="js/app.js"></script>
</body>

</html>