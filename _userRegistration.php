<?php
session_start();
require "./partials/_dbConnect.php";
require "./partials/_regularExp.php";

// error_reporting(0);

if (isset($_POST['sign_up'])) {

    $user_name = trim($_POST['userName']);
    $user_email = trim($_POST['userEmail']);
    $user_pass = trim($_POST['userPassword']);
    $user_con_pass = trim($_POST['userConPassword']);
    $user_mobile = trim($_POST['userMobile']);
    $city = trim($_POST['city']);

    if (!preg_match(userNamePattern, $user_name)) {
        $userNameError = "* Invalid User Name";
    }
    if (!preg_match(emailPattern, $user_email)) {
        $userEmailError = "* Invalid Email Id";
    }
    if (!preg_match(mobilePattern, $user_mobile)) {
        $mobileError = "* Invalid Mobile Number";
    }
    if (!preg_match(passwordPattern, $user_pass)) {
        $passwordError = "* Password must have min 5 char and max 20 char includes 0-9,a-z,A-Z,!,@,#,%,^";
    }
    if (strcmp($user_con_pass, $user_pass) != 0) {
        $ConPasswordError = "* Confirm password does not matched";
    }
    if (!preg_match(cityPattern, $city)) {
        $cityError = "* Invalid City Name";
    }

    // check all error variable they are empty that indicate data is correct
    if (
        !userExist($user_email) && ($userNameError == "") &&
        ($userEmailError == "") && ($mobileError == "") &&
        ($passwordError == "") && ($ConPasswordError == "") && ($cityError == "")
    ) {

        $sql_insert = "INSERT INTO `user`
            (`user_name`, `user_email`, `user_password`, `user_mobile_no`, `user_create_at`, `user_city`)
            VALUES ( ?, ?, ?, ?, ?, ?)";

        $timestamp = date("Y-m-d H:i:s");
        $hashPassword = md5($user_pass);

        $sql = $conn->prepare($sql_insert);
        $sql->bind_param("ssssss", $user_name, $user_email, $hashPassword, $user_mobile, $timestamp, $city);
        $result = $sql->execute();

        if ($result) {

            $_SESSION['userEmail'] = $user_email;

            $sql = $conn->prepare("SELECT `user_id` FROM `user` WHERE `user_email`=?");
            $sql->bind_param("s", $user_email);
            $sql->execute();
            $res = $sql->get_result();
            if ($res->num_rows > 0) {
                $userId = $res->fetch_assoc();
                $_SESSION['user_id'] = $userId['user_id'];

                echo "<script> alert('Account Created');
                location.href = 'index.php';
                </script>";
            }
        } else {
            echo "<script> alert('Error') </script>";
        }

        $sql->close();
    } else {
        echo "<script> alert('! User already Exist or Check form error') </script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> User Registration</title>
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <!--responsive css file-->
    <link rel="stylesheet" href="./css/media.css">
    <!-- Favicon added -->
    <link rel="shortcut icon" href="img/original_logo.png" type="image/x-icon">
</head>

<body>
    <?php require "_userNavbar.php"; ?>

    <!-- User Registration Form  start here -->
    <div class="pad-x" id="login-container">
        <div class="page-title">
            <h1 class="heading">mayi<span class="highlight">help</span>you.io</h1>
        </div>
        <div class="form-box">
            <h3>Sign-Up</h3>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="form-element">
                    <label class="form-label" for="userName">Full Name</label>
                    <input class="form-input" type="text" name="userName" id="userName"
                        placeholder="First Middle Last Name"
                        value="<?php if (isset($_POST['sign_up'])) echo $user_name; ?>" required />
                    <small class="err-msg"><?php echo $userNameError; ?></small>
                </div>
                <div class="form-element">
                    <label class="form-label" for="userMobile">Mobile No.</label>
                    <input class="form-input" type="number" name="userMobile" id="userMobile"
                        placeholder="Mobile Number" value="<?php if (isset($_POST['sign_up'])) echo $user_mobile; ?>"
                        required />
                    <small class="err-msg"> <?php echo $mobileError; ?></small>
                </div>
                <div class="form-element">
                    <label class="form-label" for="userEmail">E-mail</label>
                    <input class="form-input" type="email" name="userEmail" id="userEmail"
                        placeholder="example123@gmail.com"
                        value="<?php if (isset($_POST['sign_up'])) echo $user_email; ?>" required />
                    <small class="err-msg"><?php echo $userEmailError; ?></small>
                </div>
                <div class="form-element">
                    <label class="form-label" for="userPassword">Password</label>
                    <input class="form-input" type="password" name="userPassword" id="userPassword"
                        placeholder="Password" value="<?php if (isset($_POST['sign_up'])) echo $user_pass; ?>"
                        required />
                    <small class="err-msg"> <?php echo $passwordError; ?></small>
                </div>
                <div class="form-element">
                    <label class="form-label" for="userConPassword">Confirm Password</label>
                    <input class="form-input" type="password" name="userConPassword" id="userConPassword"
                        placeholder="Confirm Password"
                        value="<?php if (isset($_POST['sign_up'])) echo $user_con_pass; ?>" required />
                    <small class="err-msg"><?php echo $ConPasswordError; ?></small>
                </div>
                <div class="form-element">
                    <label class="form-label" for="city">City</label>
                    <input class="form-input" type="text" name="city" id="city" placeholder="Your city"
                        value="<?php if (isset($_POST['sign_up'])) echo $city; ?>" required />
                    <small class="err-msg"><?php echo $cityError; ?></small>
                </div>
                <div class="form-element">
                    <input class="form-input button submit-btn" type="submit" value="Sign Up" name="sign_up"
                        id="sign_up">
                </div>

                <hr class="form-line">
                <div class="sign-link">
                    <span>You have already account?</span>
                    <a href="_userLogin.php">Login</a>
                </div>
            </form>
        </div>
    </div>
    <!-- User Registration Form  start here -->

    <!-- Javascript Files -->
    <script src="js/app.js"> </script>
</body>

</html>