<?php

session_start();
require "../../partials/_dbConnect.php";

if (isset($_SESSION['adminEmail']) && isset($_SESSION['admin_id'])) {
    header("location:../_adminDashboard.php");
}

if (isset($_SESSION['employeeId']) && isset($_SESSION['employeeEmail'])) {
    header("location:../../employee/employeeDashboard.php");
}

if (isset($_POST['admin_login']) && !isset($_POST['check'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = $conn->prepare("SELECT * FROM `admin` WHERE admin_email = ? AND admin_password = ?");
    $sql->bind_param("ss", $email, $password);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['adminEmail'] = $row['admin_email'];

        header("location:../_adminDashboard.php");
    } else {
        echo "<script>alert('! Invalid Email or Password');</script>";
    }

    $sql->close();
} else if (isset($_POST['admin_login']) && isset($_POST['check'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $pass = md5($password);

    $sql = $conn->prepare("SELECT * FROM `employee` WHERE `emp_email` = ? AND `password` = ?");

    $sql->bind_param("ss", $email, $pass);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION['employeeId'] = $row['emp_id'];
        $_SESSION['employeeEmail'] = $row['emp_email'];

        echo "<script>alert('login successful..!');
                location.href='../../employee/employeeDashboard.php';</script>";
    } else {
        echo "<script>alert('! Invalid Email or Password');</script>";
    }

    $sql->close();
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
</head>

<body>
    <div class="pad-x form-container" id="login-container">
        <div class="page-title">
            <h1 class="heading">mayi<span class="highlight">help</span>you.io</h1>
        </div>
        <div class="form-box">
            <div class="form-heading">
                <img src="../../img/icons/adminDark.png" alt="Admin-img" class="admin-img" id="admin-img">
                <h3 id="adminHeading">Admin Login</h3>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-element">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" type="email" name="email" id="email"
                        value="<?php if (isset($_POST['login'])) echo $user_email; ?>" placeholder="E-mail" required />
                </div>
                <div class="form-element">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-input" type="password" name="password" id="password" placeholder="Password"
                        value="<?php if (isset($_POST['login'])) echo ""; ?>" required />
                </div>
                <div class="form-element">
                    <input class="form-input button submit-btn" type="submit" value="Login" name="admin_login"
                        id="login">
                    <div>
                        <input type="checkbox" name="check" id="checkAdmin" onclick="toggle()">
                        <span>Are you Employee?</span>
                        <a href="./_adminForgetPass.php" class="forgot-pass">Forgot Password</a>
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