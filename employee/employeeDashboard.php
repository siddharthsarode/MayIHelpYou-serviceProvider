<?php
session_start();
error_reporting(0);
require "../partials/_dbConnect.php";
if (!isset($_SESSION['employeeId']) && !isset($_SESSION['employeeEmail'])) {
    header("location:../admin/php/_adminLogin.php");
}

$sql = $conn->prepare("SELECT * FROM `employee` WHERE `emp_email`=?");
$sql->bind_param("s", $_SESSION['employeeEmail']);
$sql->execute();
$res = $sql->get_result();
if ($res->num_rows == 1) {
    $row = $res->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!----Custom CSS file ----->
    <link rel="stylesheet" href="../admin/css/admin.css">
    <!---- Responsive CSS file --->
    <link rel="stylesheet" href="../css/media.css">
    <!-----Custom javascript file ----->
    <script src="./js/_admin.js" defer></script>
    <style>
    body {
        background-color: gray;
    }
    </style>
</head>

<body>
    <header>
        <div class="head">
            <div class="navbar-section">
                <div class="logo-img">
                    <img src="../img/original_logo.png" alt="MayIHelpYou">
                </div>
                <div class="nav-links">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="#">privacy&policy</a></li>
                        <li><a href="#">contact us</a></li>
                    </ul>
                </div>
                <div class="nav-btn">
                    <a class="profile" href="#">Profile</a>
                    <a class="logout" href="../partials/_logout.php?emp=1">Log out</a>
                </div>
            </div>
        </div>
    </header>
    <section id="admin-container">
        <div class="side-section">
            <div class="side-container">
                <div class="side-header">
                    <div class="admin-logo">
                        <div class="img">
                            <img src="../img/icons/admin.png" alt="">
                        </div>
                        <div class="admin-profile">
                            <span>Hello,</span><br>
                            <span><?php echo $row['emp_name']; ?></span>
                        </div>
                    </div>
                    <div class="admin-operations">
                        <div class="content">
                            <div class="header">
                                <span>Employee</span>
                            </div>
                            <div class="sub-operation">
                                <ul>
                                    <li><a href="#">New Employee</a></li>
                                    <li><a href="#">Employee Report</a></li>
                                    <li><a href="#">payroll</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content">
                            <div class="header">
                                <span>Categories</span>
                            </div>
                            <div class="sub-operation">
                                <ul>
                                    <li><a href="#">New category</a></li>
                                    <li><a href="#">category list</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="content">
                            <div class="header">
                                <span>Service</span>
                            </div>
                            <div class="sub-operation">
                                <ul>
                                    <li><a href="#">New service</a></li>
                                    <li><a href="#">service list</a></li>
                                    <li><a href="#"> service employee</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="content">
                            <div class="header">
                                <span>User</span>
                            </div>
                            <div class="sub-operation">
                                <ul>
                                    <li><a href="#">Registered users</a></li>
                                    <li><a href="#">payment</a></li>
                                    <li><a href="#"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div id="main-section">
            <?php
            if (isset($_GET['emp-first'])) {
                require_once "_empRegistration.php";
            } else if (isset($_GET['emp-second'])) {
                require_once "_empReport.php";
            } else if (isset($_GET['emp-third'])) {
                require_once "_empPayroll.php";
            } else if (isset($_GET['cat-first'])) {
                require_once "_addCategory.php";
            } else if (isset($_GET['cat-second'])) {
                require_once "_categoryList.php";
            } else if (isset($_GET['service-one'])) {
                require_once "_addService.php";
            } else if (isset($_GET['service-two'])) {
                require_once "_serviceList.php";
            } else if (isset($_GET['service-third'])) {
                require_once "_empServiceList.php";
            } else if (isset($_GET['user-first'])) {
                require_once "_userReport.php";
            } else if (isset($_GET['user-second'])) {
                require_once "_userPayment.php";
            } else if (isset($_GET['admin'])) {
                require_once "_adminProfile.php";
            } else {
                require_once "_adminProfile.php";
            }
            ?>
        </div>
    </section>
    <?php require "./php/_footer.php"; ?>
</body>

</html>