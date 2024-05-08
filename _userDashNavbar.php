<header class="pad-x user-dash header" id="user-dashboard-header">
    <div class="logo-section">
        <a href="index.php">
            <img src="img/original_logo.png" alt="mayIHelpYou" class="my-logo">
        </a>
    </div>
    <nav class="navbar">
        <ul>
            <li><a href="index.php" class="navbar-link active-link">Home</a></li>
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
        <!-- <a href="_logout.php" class="button" id="user-logout">Log out</a> -->
        <?php endif; ?>
    </div>
</header>

<!-- Categories navbar bar Start Here -->
<nav class="navbar" id="cate-navbar">
    <ul class="category-list">
        <!-- Fetching categories into database and display it on user's dashboard -->
        <?php
        $fetch_cate = "SELECT `cate_id`, `cate_name` FROM `categories`";
        $result = $conn->query($fetch_cate);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo ' <li><a href="#" class="cate-link ">' . $row['cate_name'] . '</a> ';

                // Fetching services category wise
                $fetch_service = "SELECT `service_id`, `service_name` FROM `services` WHERE `service_cate_id` = {$row['cate_id']}";
                $res = $conn->query($fetch_service);
                echo '<div class="sub-menu">
                    <ul class="service-list">';
                if ($res) {
                    while ($arr_service = $res->fetch_assoc()) {
                        echo '<li><a href=_userDashboard.php?sid=' . $arr_service['service_id'] . '>' . $arr_service["service_name"] . '</a></li>';
                    }
                    echo '</ul></div></li>';
                }
            }
        } else {
            echo "<script>alert('* Poor Network'); </>";
        }
        ?>
    </ul>
</nav>
<!-- Categories navbar bar End Here -->