<?php
session_start();
// error_reporting(0);
include_once "./partials/_regularExp.php";
include_once "./partials/_dbConnect.php";
// payment data stored
if (isset($_POST['booking'])) {

    $user_mobile = trim($_POST['phone']);
    $city = trim($_POST['city']);
    $addr = trim($_POST['addr']);
    $name = trim($_POST['customerName']);
    $service_id = $_POST['service_id'];

    if (!preg_match(mobilePattern, $user_mobile) || empty($user_mobile)) {
        $mobileError = "* Invalid Mobile Number";
        echo $mobileError . "    ";
    }
    if (!preg_match(cityPattern, $city) || empty($city)) {
        $cityError = "* Invalid City Name" . "    ";
        echo $cityError;
    }

    if (!preg_match(userNamePattern, $name) || empty($name)) {
        $nameError = "* Invalid Customer Name" . "    ";
        echo $nameError;
    }

    if (!preg_match(addressPattern, $addr) || empty($addr)) {
        $adrError = "* Address should contains min 20 char includes A-Z,number,dash,etc." . "    ";
        echo $adrError;
    }

    if (empty($mobileError) && empty($cityError) && empty($nameError) && empty($adrError)) {

        $_SESSION['order_name'] = $name;
        $_SESSION['order_city'] = $city;
        $_SESSION['order_phone'] = $user_mobile;
        $_SESSION['order_adr'] = $addr;
        $_SESSION['service_id'] = $service_id;

        echo "Details Accepted ,Pay Advance Online";
    }
}

if (isset($_POST['order_confirm'])) {
    $transactionId = $_POST['transactionId'];
    if (empty($transactionId)) {
        echo "* Please Enter valid transaction Id..!";
    } else {

        $name = $_SESSION['order_name'];
        $city = $_SESSION['order_city'];
        $user_mobile = $_SESSION['order_phone'];
        $addr = $_SESSION['order_adr'];
        $email = $_SESSION['userEmail'];
        $service_id = $_SESSION['service_id'];
        $userId = $_SESSION['user_id'];

        $sql = $conn->prepare("INSERT INTO `order_details`(`order_details_id`,`customer_name`,`customer_email`,`contact_no`,`service_address`,`order_service_id`,`customer_city`)
                            VALUES(null,?,?,?,?,?,?)");
        $sql->bind_param("ssssss", $name, $email, $user_mobile, $addr, $service_id, $city);
        $result = $sql->execute();

        $status = "pending";

        $sql = $conn->prepare("INSERT INTO `user_order`(`order_id`,`order_create_at`,`create_update`,`order_status`,`order_emp_id`)
                            VALUES(null,current_timestamp,current_timestamp,?,null)");
        $sql->bind_param("s", $status);
        $result1 = $sql->execute();

        $sql = $conn->prepare("SELECT `order_id` FROM `user_order` ORDER BY `order_id` DESC LIMIT 1");
        $sql->execute();
        $res = $sql->get_result();
        $ordId = $res->fetch_column();

        $sql = $conn->prepare("SELECT `order_details_id` FROM `order_details` ORDER BY `order_details_id` DESC LIMIT 1");
        $sql->execute();
        $res = $sql->get_result();
        $ordDetailsId = $res->fetch_column();

        $sql = $conn->prepare("INSERT INTO `order_to_order_details`(`ord_id`,`ord_details_id`)VALUES(?,?)");
        $sql->bind_param("ss", $ordId, $ordDetailsId);
        $result2 = $sql->execute();

        $payment_status = "success";
        $sql = $conn->prepare("INSERT INTO `user_payment`(`payment_id`,`transaction_id`,`payment_user_id`,`payment_order_id`,`payment_status`)
                            VALUES(null,?,?,?,?)");
        $sql->bind_param("ssss", $transactionId, $userId, $ordId, $payment_status);
        $result3 = $sql->execute();

        if ($result && $result1 && $result2 && $result3) {
            echo "Order Accepted";
            $from = "gopalsadavarte555@gmail.com";
            $header = "From:$from";
            $subject = "Thanks, For Give Chance to help you!!";
            $message = "Dear," . $name . "Thanks for giving chance to serve best services to you and we have also request to you to give more information about aur site to other your relatives and make more chances to give best services to you peoples !!";
            if (mail($email, $subject, $message, $header)) {
                echo "Mail send on your Registered email id";
            } else {
                echo "Network Problem, mail cannot sent!!";
            }

            unset($_SESSION['order_name']);
            unset($_SESSION['order_city']);
            unset($_SESSION['order_phone']);
            unset($_SESSION['order_adr']);
            unset($_SESSION['service_id']);
        }
    }
}
