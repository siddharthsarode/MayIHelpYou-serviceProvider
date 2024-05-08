<!-- Navbar start here -->
<header class="pad-x header">
    <div class="logo-section">
        <a href="index.php">
            <img src="img/original_logo.png" alt="mayIHelpYou" class="my-logo">
        </a>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="index.php" class="navbar-link active-link">Home</a></li>
            <li><a href="index.php#services" class="navbar-link">Services</a></li>
            <li><a href="index.php#contact" class="navbar-link">Contacts</a></li>
            <li><a href="#" class="navbar-link">Privacy & Policy</a></li>
            <li><a href="#" class="navbar-link">Help</a></li>
        </ul>
    </nav>
    <div class="login-section">
        <?php if (!isset($_SESSION['userEmail'])) : ?>
        <a href="./_userLogin.php" class="user-login">
            <img src="img/default_profile.png" class="icon user-icon" alt="">
            <span class="login-text">Sign-up / Login</span>
        </a>
        <?php else : ?>
        <a href="_userDashboard.php" class="link button account">
            <img src="img/icons/user.png" class="user-icon" alt="">
            <span>My Profile</span>
        </a>
        <a href="./partials/_logout.php?user=1" class="button btn-red">Log out</a>
        <?php endif; ?>
    </div>
    <!-- <div class="menu-container">
            <img src="img/icons/menu-icon.png" class="icon" id="menu" alt="Menu">
            <img src="img/icons/close-icon.png" class="icon" id="close" alt="close">
        </div> -->
</header>

<!-- Navbar end here -->