<?php
session_start();
include_once "partials/_regularExp.php";
include_once "partials/_dbConnect.php";

// Contact form validation and data save process start here
if (isset($_POST['contact_form'])) {
    if (!isset($_SESSION['userEmail'])) {
        echo "<script> alert('!Please Login');
        location.href = '_userLogin.php';
        </script>";
    } else {

        $con_username = trim($_POST['con-user-name']);
        $con_user_email = trim($_POST['con-user-email']);
        $con_msg = trim($_POST['msg']);
        $msg_len = strlen($con_msg);

        // validation email and user name of contact form
        if (!preg_match(userNamePattern, $con_username)) {
            $userNameError = "* Invalid User Name";
        }
        if (!preg_match(emailPattern, $con_user_email)) {
            $userEmailError = "* Invalid Email Id";
        }

        if ($msg_len < 15 || $msg_len > 500) {
            $contactErrorMsg = "* Massage should between 15 and 500 characters";
        }

        // Validation End Here

        // user table -> user email
        $userEmail = $_SESSION['userEmail'];
        $user_id = 0;

        // get user id from user table
        $sql = $conn->prepare("SELECT `user_id`, `user_name` FROM `user` WHERE `user_email` = ?");
        $sql->bind_param("s", $userEmail);
        $sql->execute();

        $result = $sql->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
        }

        if (($userNameError == "") && ($userEmailError == "") && ($contactErrorMsg == "")) {
            $sql = $conn->prepare(
                "INSERT INTO `contact`
            (`con_user`, `con_email`, `message`, `con_create_at`, `con_user_id`,`con_status`)
            VALUES (?, ?, ?, NOW(), ?,?)" // NOW() is used to current timestamp
            );
            $status = "pending";
            $sql->bind_param("sssis", $con_username, $con_user_email, $con_msg, $user_id, $status);
            $result = $sql->execute();

            if ($result) {
                echo "<script> alert('Your massage submitted successfully');
            location.href = 'index.php';
            </script>";
            } else {
                echo "<script> alert('!Network Problem'); </script>";
            }

            $sql->close();
        } else {
            echo "<script>
            alert('! Something wrong in contact form')
            location.href = 'index.php#contact'
            </script>";
        }
    }
}
// Contact form validation and data save process end here
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        May I Help You - Service provider
    </title>
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <!--responsive css file-->
    <link rel="stylesheet" href="./css/media.css">
    <!-- Favicon added -->
    <link rel="shortcut icon" href="img/original_logo.png" type="image/x-icon">

</head>

<body>
    <!-- Navbar code include -->
    <?php require "_userNavbar.php"; ?>

    <!-- Home Section start Here -->
    <main>
        <div class="main-container pad-x">
            <div class="intro">
                <h1>Our Services <span></span></h1>
                <h2 class="heading">Need it fixed? <br> we <span>care</span> to <br> fix it right.</h2>
                <p>Customer's happiness is our aim</p>
                <div class="help-link">
                    <a href="index.php#services" class="button">Services</a>
                    <a href="index.php#contact" class="button">Contacts</a>
                </div>
            </div>
        </div>
    </main>
    <!-- Home Section End Here -->

    <!-- Service section Start Here -->
    <section id="services">
        <div class="section-heading">
            <h1 class="heading center">Our <span class="clip-path">Services</span></h1>
        </div>
        <div class="search-box">
            <h2 class="heading center">Choice a service to get started.</h2>
            <div class="form-element">
                <input type="search" name="search" id="search-service" class="form-input"
                    placeholder="Search for a service (e.g 'Cleaning')">
                <button type="button" class="btn search-btn">Search</button>
            </div>
        </div>

        <div class="service-wrapper" id="service-wrap">
            <div class="categories-section">
                <h2 class="heading">All Categories</h2>
                <ul>
                    <li><a href="#plumbing" class="cat-link">Plumbing</a></li>
                    <li><a href="#cleaning" class="cat-link">Cleaning</a></li>
                    <li><a href="#electrical" class="cat-link">Electrical</a></li>
                    <li><a href="#appliances" class="cat-link">Appliances Repairs</a></li>
                    <li><a href="#carpentry" class="cat-link">Carpentry</a></li>
                    <li><a href="#emergency" class="cat-link">Emergency</a></li>
                    <li><a href="#painting" class="cat-link">Painting</a></li>
                    <li><a href="#Moving" class="cat-link">Moving</a></li>
                    <li><a href="#" class="cat-link">Landscaping & Gardening</a></li>
                </ul>
            </div>
            <div class="service-info">
                <!-- Plumbing Services Fetching Here -->
                <div class="service-box" id="plumbing">
                    <h2 class="ser-heading">Plumbing</h2>
                    <div class="box-container">
                        <?php
                        $sql = "SELECT * FROM services WHERE service_cate_id = 1";
                        $result = $conn->query($sql);

                        if ($result) {
                            // Check if any rows were returned
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="box shadow">
                            <div class="box-body">
                                <a href="_userDashboard.php?sid=<?php echo $row["service_id"]; ?>">
                                    <img src="<?php echo $row["image_path"]; ?>" alt="">
                                </a>
                            </div>
                            <div class="box-title">
                                <p><?php echo $row["service_name"]; ?></p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        } else {
                            // Query execution failed
                            echo "Error: " . $conn->error;
                        }
                        ?>
                    </div>
                </div>

                <!-- Cleaning Services Fetching Here -->
                <div class="service-box" id="cleaning">
                    <h2 class="ser-heading">Cleaning</h2>
                    <div class="box-container">
                        <?php
                        $sql = "SELECT * FROM services WHERE service_cate_id = 2";
                        $result = $conn->query($sql);

                        if ($result) {
                            // Check if any rows were returned
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="box shadow">
                            <div class="box-body">
                                <a href="_userDashboard.php?sid=<?php echo $row["service_id"]; ?>">
                                    <img src="<?php echo $row["image_path"]; ?>" alt="">
                                </a>
                            </div>
                            <div class="box-title">
                                <p><?php echo $row["service_name"]; ?></p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        } else {
                            // Query execution failed
                            echo "Error: " . $conn->error;
                        }
                        ?>

                    </div>
                </div>
                <!-- Electrical Services Fetching Here  -->
                <div class="service-box" id="electrical">
                    <h2 class="ser-heading">Electrical</h2>
                    <div class="box-container">
                        <?php
                        $sql = "SELECT * FROM services WHERE service_cate_id = 3";
                        $result = $conn->query($sql);

                        if ($result) {
                            // Check if any rows were returned
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="box shadow">
                            <div class="box-body">
                                <a href="_userDashboard.php?sid=<?php echo $row["service_id"]; ?>">
                                    <img src="<?php echo $row["image_path"]; ?>" alt="">
                                </a>
                            </div>
                            <div class="box-title">
                                <p><?php echo $row["service_name"]; ?></p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        } else {
                            // Query execution failed
                            echo "Error: " . $conn->error;
                        }
                        ?>
                    </div>
                </div>
                <div class="service-box" id="appliances">
                    <h2 class="ser-heading">Appliance Repair</h2>
                    <div class="box-container">
                        <?php
                        $sql = "SELECT * FROM services WHERE service_cate_id = 4";
                        $result = $conn->query($sql);

                        if ($result) {
                            // Check if any rows were returned
                            if ($result->num_rows > 0) {
                                // Loop through each row
                                while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="box shadow">
                            <div class="box-body">
                                <a href="_userDashboard.php?sid=<?php echo $row["service_id"]; ?>">
                                    <img src="<?php echo $row["image_path"]; ?>" alt="">
                                </a>
                            </div>
                            <div class="box-title">
                                <p><?php echo $row["service_name"]; ?></p>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        } else {
                            // Query execution failed
                            echo "Error: " . $conn->error;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service section End Here -->


    <!-- Our Best Worker Section Start Here -->
    <section class="pad-x" id="worker-section">
        <div class="section-heading">
            <h1 class="heading center">Our <span class="clip-path">Members</span></h1>
        </div>
        <div class="wrapper">
            <div class="slider-btn" id="prev">Prev</div>
            <div class="slider-btn" id="next">Next</div>
            <div class="slider" id="members-slider">
                <?php
                $sql = $conn->prepare("SELECT `emp_name`,`profile_picture` FROM `employee`");
                $sql->execute();
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                ?>
                <div class="emp-card">
                    <div class="card-img">
                        <img src="<?php echo substr($row['profile_picture'], 1); ?>"
                            alt="<?php echo $row['emp_name']; ?>">
                    </div>
                    <div class="card-body">
                        <h2><?php echo $row['emp_name']; ?></h2>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        </div>
    </section>
    <!-- Our Best Worker Section End Here -->

    <!-- Contact Section Start Here (User's query) -->
    <section id="contact">

        <div class="contact-container pad-x">
            <div class="section-heading">
                <h1 class="heading center">Our <span class="clip-path">Contact</span></h1>
            </div>

            <div class="contact-wrapper">
                <div class="form-side">
                    <div class="form-container">
                        <div class="form-title">
                            <h1 class="heading">Contact Us</h1>

                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                            <div class="form-element">
                                <label class="form-label" for="name">Full Name</label>
                                <input class="form-input" type="text" name="con-user-name" id="email" placeholder="Name"
                                    value="<?php if (isset($_POST['contact_form'])) echo $con_username; ?>" required />
                                <small class="err-msg"> <?php echo $userNameError; ?></small>
                            </div>
                            <div class="form-element">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-input" type="email" name="con-user-email" id="email"
                                    placeholder="E-mail"
                                    value="<?php if (isset($_POST['contact_form'])) echo $con_user_email; ?>"
                                    required />
                                <small class="err-msg"> <?php echo $userEmailError; ?></small>
                            </div>
                            <div class="form-element">
                                <label class="form-label" for="phone">Massage</label>
                                <textarea name="msg" id="msg" class="form-input text-area"
                                    placeholder="Describe your thoughts..." required></textarea>
                                <small class="err-msg"> <?php echo $contactErrorMsg; ?></small>
                            </div>
                            <div class="form-element">
                                <input class="form-input button" type="submit" value="Send" name="contact_form"
                                    id="contact-form">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="info-side">
                    <div class="info-container">
                        <h1 class="heading">Info</h1>
                        <div class="about-info">
                            <div class="row">
                                <p>It is very important for us to keep in touch with you, so
                                    we are always ready to
                                    answer any question that interests you. Shoot!</p>
                            </div>
                            <div class="row">
                                <p class="info-text"><span>Email: </span>
                                    help@mayihelpyou.io</p>
                            </div>
                            <div class="row">
                                <p class="info-text"><span>Phone: </span> +91 000222</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- Contact Section End Here  (User's query)-->

    <!-- Import footer section -->
    <?php require "_footer.php"; ?>


    <!-- Javascript Files -->
    <script src="./js/app.js"></script>
    <script src="./js/textAnimation.js"></script>
</body>

</html>