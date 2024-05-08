<?php
session_start();
require "../partials/_regularExp.php";

if (!isset($_SESSION['adminEmail']) && !isset($_SESSION['admin_id'])) {
    header("location:./php/_adminLogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <a href=></a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'May I Help You' Dashboard</title>
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="../css/media.css">
</head>

<body>
    <main>
        <div class="wrapper">
            <aside>
                <div class="logo">
                    <a href="../index.php">
                        <img src="../img/original_logo.png" alt="MayIHelpYou" class="my-logo">
                    </a>
                </div>
                <div class="links">
                    <ul>
                        <li><a href="_adminDashboard.php?admin=1">Dashboard</a></li>
                        <li><a href="_adminDashboard.php?admin=2">Employee Registration</a></li>
                        <li><a href="_adminDashboard.php?admin=3">Edit Employee</a></li>
                        <li><a href="_adminDashboard.php?emp-second=1">Employee Report</a></li>
                        <li><a href="#">Employee payroll</a></li>
                        <li><a href="_adminDashboard.php?cat-first=1">New category</a></li>
                        <li><a href="_adminDashboard.php?cat-second=1">category list</a></li>
                        <li><a href="_adminDashboard.php?service-one=1">Add Service</a></li>
                        <li><a href="_adminDashboard.php?service-three=1">Edit Service</a></li>
                        <li><a href="_adminDashboard.php?service-two=1">Service List</a></li>
                        <li><a href="_adminDashboard.php?service-third=1">Service Employee</a></li>
                        <li><a href="_adminDashboard.php?user-first=1">Registered users</a></li>
                        <li><a href="_adminDashboard.php?user-second=1">payment</a></li>
                        <li><a href="_adminDashboard.php?user-query=1">User Queries</a></li>
                        <li><a href="_adminDashboard.php?admin-signup=1">Admin Sign-Up</a></li>
                        <li><a href="#">Notification</a></li>
                        <li><a href="#">Settings</a></li>
                        <li><a href="../partials/_logout.php?admin=1" class="log-out">Log-out</a></li>
                    </ul>
                </div>
            </aside>
            <div class="dashboard" id="dashboard">
                <nav>
                    <div class="search">
                        <i><img src="../img/icons/search-interface-symbol.png" alt=""></i>
                        <input type="search" name="search" id="search" placeholder="Search">
                    </div>
                    <div class="navbar-right">
                        <div class="admin-nav-icons">
                            <a href="#"><img src="../img/icons/envelope-solid.png" alt=""></a>
                            <a href="#"><img src="../img/icons/gear-solid.png" alt=""></a>
                        </div>
                    </div>
                </nav>
                <div class="dash-container" id="dash-content">

                    <?php
                    if (isset($_GET['admin']) && $_GET['admin'] == 1) {
                        require "_adminProfile.php";
                    } else if (isset($_GET['admin']) && $_GET['admin'] == 2) {
                        require "_empRegistration.php";
                    } else if (isset($_GET['emp-second'])) {
                        require "_empReport.php";
                    } else if (isset($_GET['emp-third'])) {
                        require "_empPayroll.php";
                    } else if (isset($_GET['cat-first'])) {
                        require "_addCategory.php";
                    } else if (isset($_GET['cat-second'])) {
                        require "_categoryList.php";
                    } else if (isset($_GET['service-one'])) {
                        require "_addService.php";
                    } else if (isset($_GET['service-two'])) {
                        require "_serviceList.php";
                    } else if (isset($_GET['service-third'])) {
                        require "_empByService.php";
                    } else if (isset($_GET['user-first'])) {
                        require "_usersList.php";
                    } else if (isset($_GET['user-second'])) {
                        require "_receivedOrders.php";
                    } else if (isset($_GET['user-query'])) {
                        require "_userQueryReport.php";
                    } else if (isset($_GET['admin']) && $_GET['admin'] == 3) {
                        require "_empUpdate.php";
                    } else if (isset($_GET['service-three'])) {
                        require "_serviceUpdate.php";
                    } else if (isset($_GET['admin-signup'])) {
                        require "./php/_adminSignup.php";
                    } else {
                        require "_adminProfile.php";
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

</body>

</html>