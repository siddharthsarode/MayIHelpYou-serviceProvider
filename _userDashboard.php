<?php
session_start();
include_once "./partials/_dbConnect.php";
include_once "./partials/_regularExp.php";
// if (!isset($_SESSION['user_id']) && !isset($_SESSION['userEmail'])) {
//     header("location:_userLogin.php");
// }

if (isset($_POST['save_name'])) {
    $name = $_POST['user-name'];
    if (preg_match(userNamePattern, $name)) {
        $sql = $conn->prepare("UPDATE `user` SET `user_name`=? WHERE `user_id`=? AND `user_email`=?");
        $email = $_SESSION['userEmail'];
        $userId = $_SESSION['user_id'];
        $sql->bind_param("sss", $name, $userId, $email);
        $sql->execute();
        $res = $sql->get_result();
        if ($res) {
            echo '<meta http-equiv="refresh" content="0;_userDashboard.php">';
        }
    } else {
        echo "<script>alert('Please!Enter valid user name!');</script>";
    }
}

if (isset($_POST['save_email'])) {
    $email = $_POST['user-email'];
    if (preg_match(emailPattern, $email) || !userExist($email)) {
        $sql = $conn->prepare("UPDATE `user` SET `user_email`=? WHERE `user_id`=? AND `user_email`=?");
        $emailVerify = $_SESSION['userEmail'];
        $userId = $_SESSION['user_id'];
        $sql->bind_param("sss", $email, $userId, $emailVerify);
        $sql->execute();
        $res = $sql->get_result();
        $_SESSION['userEmail'] = $email;
        if ($res) {
            echo '<meta http-equiv="refresh" content="0;_userDashboard.php">';
        }
    } else {
        echo "<script>alert('Invalid Email or Email already Exist!!');</script>";
    }
}

if (isset($_POST['save_number'])) {
    $mobile = $_POST['user-mobile'];
    if (preg_match(mobilePattern, $mobile)) {
        $sql = $conn->prepare("UPDATE `user` SET `user_mobile_no`=? WHERE `user_id`=? AND `user_email`=?");
        $email = $_SESSION['userEmail'];
        $userId = $_SESSION['user_id'];
        $sql->bind_param("sss", $mobile, $userId, $email);
        $sql->execute();
        $res = $sql->get_result();
        if ($res) {
            echo '<meta http-equiv="refresh" content="0;_userDashboard.php">';
        }
    } else {
        echo "<script>alert('Invalid Mobile Number!!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <!---- Responsive CSS file --->
    <link rel="stylesheet" href="./css/media.css">
    <!-- Favicon added -->
    <link rel="shortcut icon" href="img/original_logo.png" type="image/x-icon">
</head>

<body>
    <!-- Included user dashboard navbar here -->
    <?php include_once "_userDashNavbar.php"; ?>
    <?php
    if (isset($_GET['sid'])) {
        include "php/_serviceOrder.php";
    } else {
        // Fetch user data
        $sql_query = "SELECT * FROM `user` WHERE `user_email` = ?";

        $sql = $conn->prepare($sql_query);

        $user_email = $_SESSION['userEmail'];

        $sql->bind_param("s", $user_email);
        $sql->execute();

        $result = $sql->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        }
    ?>
    <!-- User's Dashboard start here -->
    <div class="user-dashboard pad-x" id="dashboard">
        <div class="user-sidebar">
            <div class="user-operation">
                <div class="user-profile op-padding shadow" id="userProfile">
                    <img src="img/profile-pic.png" alt="Profile" class="profile">
                    <div class="name-info">
                        <div class="hello">Hello,</div>
                        <div class="user-name"><?php if (isset($row['user_name'])) echo $row['user_name']; ?></div>
                    </div>
                </div>
                <div class="user-links-container op-padding shadow">
                    <div class="order lg-pad-b dash-info">
                        <div class="dash-box">
                            <img src="img/icons/order-icon.png" alt="order-icon" class="dashboard-icon">
                            <div> <a id="myOrder" href="_userDashboard.php?order=1">My Orders</a></div>
                        </div>
                    </div>
                    <div class="user-account lg-pad-b dash-info">
                        <div>
                            <div class="dash-box">
                                <img src="img/icons/user-dash-icon.png" alt="user-icon" class="dashboard-icon">
                                <div>Account Manage</div>
                            </div>
                            <div class="dash-links">
                                <a href="#">Profile information</a>
                                <a href="#">Manage Addresses</a>
                                <a href="#">PAN Card information</a>
                            </div>
                        </div>
                    </div>

                    <div class="payment lg-pad-b dash-info">
                        <div class="dash-box">
                            <img src="img/icons/payment-icon.png" alt="user-icon" class="dashboard-icon">
                            <div>Payments</div>
                        </div>
                        <div class="dash-links">
                            <a href="#">Gift Cards</a>
                            <a href="#">Saved UPI</a>
                            <a href="#">Saved Cards</a>
                        </div>
                    </div>

                    <div class="stuff lg-pad-b dash-info">
                        <div class="dash-box">
                            <img src="img/icons/my-stuff-icon.png" alt="user-icon" class="dashboard-icon">
                            <div>My Stuff</div>
                        </div>
                        <div class="dash-links">
                            <a href="#">My Coupons</a>
                            <a href="#">My Reviews & rating UPI</a>
                            <a href="#">All Notification</a>
                            <a href="#">My Wishlist</a>
                        </div>
                    </div>

                    <div class="logout lg-pad-b dash-info">
                        <div class="dash-box">
                            <img src="img/icons/power-off-icon.png" alt="user-icon" class="dashboard-icon">
                            <div><a href="./partials/_logout.php?user=1" class="dash-logout">Logout</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="user-content">

            <div class="user-container shadow op-padding" id="user-container">
                <?php
                    if (isset($_GET['order'])) {
                        require "./userDashboard/_userOrders.php";
                    } else {
                        require "./userDashboard/_manageProfile.php";
                    } ?>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php include_once "_footer.php"; ?>
    <!-- User's Dashboard End here -->
    <script src="js/app.js"></script>
    <script src="js/userDashboard.js"></script>
    <script src="js/serviceOrder.js"></script>
</body>

</html>