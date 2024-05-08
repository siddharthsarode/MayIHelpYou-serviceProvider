<?php
session_start();

include_once "partials/_dbConnect.php";

if (!isset($_GET['sid'])) {
    header("location:_userDashboard.php");
}
if (!isset($_SESSION['userEmail'])) {
    echo '<script>alert("*Please Login first");
    location.href = "_userLogin.php";
    </script>';
} else {
    $user_email = $_SESSION['userEmail'];
    $fetch_user = "SELECT `user_name`, `user_mobile_no`, `user_city` FROM `user` WHERE `user_email` = '$user_email'";
    $res = $conn->query($fetch_user);
    if ($res->num_rows == 1) {
        $user_info = $res->fetch_assoc();
        // echo "<script>alert('Success')</script>";
    } else {
        echo "<script>alert('Success')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <!--responsive css file-->
    <link rel="stylesheet" href="./css/media.css">
    <!-- Favicon added -->
    <link rel="shortcut icon" href="img/original_logo.png" type="image/x-icon">
</head>

<body>

    <!-- payment navbar -->
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

            <a href="_userDashboard.php" class="link button account">
                <img src="img/icons/user.png" class="user-icon" alt="">
                <span>My Profile</span>
            </a>
        </div>
    </header>
    <div class="container" id="payment">
        <div class="grid-container">
            <div class="payment-section">
                <div class="payment-form">
                    <form id="orderForm" autocomplete="off">
                        <h2>Service Address</h2>
                        <div class="form-element">
                            <label class="form-label" for="customerName">Customer Name</label>
                            <input class="form-input" type="text" name="customerName" id="customerName"
                                placeholder="Enter your address" value="<?php echo $user_info['user_name']; ?>"
                                required />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="addr">Street address</label>
                            <input class="form-input" type="text" name="addr" id="addr" placeholder="Enter your address"
                                required />
                        </div>
                        <div class="form-input-group">
                            <div class="form-element">
                                <label class="form-label" for="city">City</label>
                                <input class="form-input" type="text" name="city" id="city"
                                    value="<?php echo $user_info['user_city']; ?>" required />
                            </div>
                            <div class="form-element">
                                <label class="form-label" for="phone">Phone number</label>
                                <input class="form-input" type="number" name="phone" id="phone"
                                    value="<?php echo $user_info['user_mobile_no']; ?>" required />
                            </div>
                        </div>
                        <h2>Payment Information (optional)</h2>
                        <div class="form-element">
                            <label class="form-label" for="card_num">Credit Card Number</label>
                            <input class="form-input" type="text" name="card_num" id="card_num" />
                        </div>
                        <div class="form-input-group">
                            <div class="form-element">
                                <label class="form-label" for="card_exp">Expiration</label>
                                <input class="form-input" type="text" name="card_exp" id="card_exp"
                                    placeholder="MM/YY" />
                            </div>
                            <div class="form-element">
                                <label class="form-label" for="card_code">Security Code</label>
                                <input class="form-input" type="text" name="card_code" id="card_code"
                                    placeholder="CVC" />
                                <input class="form-input" type="hidden" name="service_id" id="service_id"
                                    value="<?php if (isset($_GET['sid'])) echo $_GET['sid']; ?>">
                            </div>
                        </div>
                        <h2>Payment done by user</h2>
                        <div class="form-element">
                            <button class="form-input button submit-btn" name="booking" id="booking-btn">Book
                                Now</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if (isset($_GET['sid'])) {
                $sid = $_GET['sid'];

                $fetch_service = "SELECT `service_name`, `description` FROM `services` WHERE `service_id` = $sid";
                $ser_result = $conn->query($fetch_service);

                if ($ser_result->num_rows == 1) {
                    $ser_row = $ser_result->fetch_assoc();
                } else {
                    echo "<script>alert('Error - Service cannot fetch');</script>";
                }
            }
            ?>
            <div class="aside">
                <div class="price-details">
                    <h2>Service Information</h2>
                    <h1 class="service-name"><?php if (isset($_GET['sid'])) echo $ser_row['service_name']; ?></h1>
                    <p style="font-size: 1.4rem;color: var(--text);line-height: 1.6;">
                        <?php if (isset($_GET['sid'])) echo $ser_row['description']; ?></p>
                    <div class="notes">
                        <h3 class="note">Notes:</h3>
                        <ul>
                            <li>
                                Min 100₹ booking charges, don't worry this amount will reduce in final pay amount.
                            </li>
                            <li>
                                We can refund your amount before booking confirmed, After booking confirmed We returned
                                you
                                50% of booking amount.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="payment-container" id="payment-page">
        <div class="payment-section">
            <div class="payment-head">
                <h2>Payment Info</h2>
                <img src="./img/icons/close.png" alt="close" id="close-payment-page">
            </div>
            <div class="container">
                <div class="scan-content">
                    <div class="scanner">
                        <div class="qr-code">
                            <img src="./img/icons/QR-code.jpg" alt="QR-Code">
                        </div>
                    </div>
                    <div class="notes">
                        <h2>Instructions:</h2>
                        <span> <img src="./img/icons/angle-down-solid.png"> The amount, which paid by you.this amount
                            will reduce in final payment</span>
                        <span> <img src="./img/icons/angle-down-solid.png"> The amount, which paid by you.this amount
                            will reduce in final payment</span>
                        <span> <img src="./img/icons/angle-down-solid.png"> The amount, which paid by you.this amount
                            will reduce in final payment</span>
                        <span> <img src="./img/icons/angle-down-solid.png"> The amount, which paid by you.this amount
                            will reduce in final payment</span>
                        <span> <img src="./img/icons/angle-down-solid.png"> The amount, which paid by you.this amount
                            will reduce in final payment</span>
                    </div>
                </div>
                <div class="form-content">
                    <form id="payment-details-form" autocomplete="off">
                        <div class="form-element">
                            <label for="transactionId">Transaction Id</label>
                            <input type="text" class="form-input" id="transactionId" placeholder="transaction id.."
                                required>
                        </div>
                        <div class="form-element">
                            <label for="price">Service Advance Amount</label>
                            <input type="text" id="price" class="form-input" value="100" readonly>
                        </div>
                        <div class="form-element">
                            <button id="payment-btn" name="payment" class="form-input button submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- included footer -->
    <?php include_once "_footer.php"; ?>

    <script src="./js/orderBook.js"></script>
</body>

</html>