<?php
require "partials/_dbConnect.php";

session_start();
error_reporting(0);

if (isset($_SESSION['userEmail'])) {
    header("location: index.php");
}

if (isset($_POST['login'])) {

    $user_email = trim($_POST['email']);
    $user_pass = md5(trim($_POST['password']));

    $sql = $conn->prepare("SELECT `user_id`, `user_email`, `user_password` FROM `user`
                WHERE `user_email` = ? AND `user_password` = ?");

    $sql->bind_param("ss", $user_email, $user_pass);
    $sql->execute();

    $result = $sql->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['userEmail'] = $row['user_email'];

        header("location: index.php");
    } else {
        echo "<script>alert('! Invalid Email or Password');</script>";
    }

    $sql->close();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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
            <h3>Login</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
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
                    <input class="form-input button submit-btn" type="submit" value="Login" name="login" id="login">
                    <div>
                        <a href="_userForget.php" class="forgot-pass">Forgot Password</a>
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
    <!-- Login container End -->

    <!-- Javascript Files -->
    <script src="js/app.js"></script>
</body>

</html>