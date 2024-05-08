<?php
// session_start();
if (!isset($_SESSION['adminEmail']) && !isset($_SESSION['admin_id'])) {
    header("location:../_adminDashboard.php");
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
</head>

<body>
    <div class="form-container" id="login-container">
        <div class="page-title" style="margin:-2rem 0 -2rem 0;">
            <h1 class="heading" style="font-size: 4rem;">mayi<span class="highlight">help</span>you.io</h1>
        </div>
        <div class="form-box">
            <div class="form-heading">
                <img src="../img/icons/adminDark.png" alt="Admin-img" class="admin-img" id="admin-img">
                <h3 id="adminHeading">Admin Sign-Up</h3>
            </div>
            <form id="admin-sign-up-form">
                <div class="form-element">
                    <label for="adminName" class="form-label">Name</label>
                    <input type="text" name="adminName" id="adminName" class="form-input" placeholder="Name">
                </div>
                <div class="form-element">
                    <label class="form-label" for="email">Email</label>
                    <input class="form-input" type="email" name="email" id="email" placeholder="E-mail" />
                </div>
                <div class="form-element">
                    <label class="form-label" for="password">Password</label>
                    <input class="form-input" type="password" name="password" id="password" placeholder="Password" />
                </div>
                <div class="form-element">
                    <button class="form-input button submit-btn" id="admin-btn">Sign-Up</button>
                </div>
            </form>
            <hr class="form-line">
            <div class="sign-link">
                <span>Go to home page ?</span>
                <a href="../index.php">Home</a>
            </div>
        </div>
    </div>
    <script src="./js/_adminSignUp.js"></script>
</body>

</html>