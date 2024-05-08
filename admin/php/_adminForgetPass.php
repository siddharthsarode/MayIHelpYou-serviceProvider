<?php

session_start();
require "../../partials/_dbConnect.php";
require "../../partials/_regularExp.php";

if (isset($_POST['admin-forget']) && !isset($_POST['check'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if (preg_match(passwordPattern, $password)) {
        $sql = $conn->prepare("UPDATE `admin` SET `admin_password`=? WHERE `admin_email`=?");
        $sql->bind_param("ss", $password, $email);
        $res = $sql->execute();
        if ($res) {
            echo "<script>alert('Password updated successfully..!');
                  location.href='./_adminLogin.php';</script>";
        } else {
            echo "<script>alert('Sorry,password could not updated..!');</script>";
        }
        $sql->close();
    } else {
        echo "<script>alert('!Password length min 5 and max 20 char,contains 0-9,a-z, A-Z,!,@,#,%,^');</script>";
    }
} else if (isset($_POST['admin-forget']) && isset($_POST['check'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (preg_match(passwordPattern, $password)) {
        $sql = $conn->prepare("UPDATE `employee` SET `password`=? WHERE `emp_email`=?");
        $pass = md5($password);
        $sql->bind_param("ss", $pass, $email);
        $res = $sql->execute();
        if ($res) {
            echo "<script>alert('Password updated successfully..!');
                  location.href='./_adminLogin.php';</script>";
        } else {
            echo "<script>alert('Sorry,password could not updated..!');</script>";
        }
        $sql->close();
    } else {
        echo "<script>alert('!Password length min 5 and max 20 char,contains 0-9,a-z, A-Z,!,@,#,%,^');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!----Custom CSS file ----->
    <link rel="stylesheet" href="../css/admin.css">
    <!---- Responsive CSS file --->
    <link rel="stylesheet" href="../../css/media.css">
    <!-----Custom javascript file ----->
    <script src="../js/_admin.js" defer></script>
    <style>
    body {
        background-color: white;
    }
    </style>
</head>

<body>
    <div class="pad-x form-container" id="login-container">
        <div class="page-title">
            <h1 class="heading">mayi<span class="highlight">help</span>you.io</h1>
        </div>
        <div class="form-box">
            <div class="form-heading">
                <img src="../../img/icons/adminDark.png" alt="Admin-img" class="admin-img">
                <h3 id="forgetHeading">Admin Forget Password</h3>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-element">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" type="email" name="email" id="email"
                        value="<?php if (isset($_POST['login'])) echo $user_email; ?>" placeholder="E-mail" required />
                </div>
                <div class="form-element">
                    <label class="form-label" for="password">New Password</label>
                    <input class="form-input" type="password" name="password" id="password" placeholder="Password"
                        required />
                </div>
                <div class="form-element">
                    <input class="form-input button submit-btn" type="submit" value="Forget" name="admin-forget"
                        id="login">
                    <div>
                        <input type="checkbox" name="check" id="forgetCheck" onclick="toggleForget()">
                        <span>Are you Employee?</span>
                        <a href="./_adminLogin.php" class="forgot-pass">Login</a>
                    </div>
                </div>
            </form>
            <hr class="form-line">
            <div class="sign-link">
                <span>Go to home page ?</span>
                <a href="../../index.php">Home</a>
            </div>

        </div>
    </div>
</body>

</html>