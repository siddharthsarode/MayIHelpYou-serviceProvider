<?php
session_start();
error_reporting(0);
if (isset($_GET['emp'])) {
    if (isset($_SESSION['employeeId']) && isset($_SESSION['employeeEmail'])) {
        unset($_SESSION['employeeId']);
        unset($_SESSION['employeeEmail']);
        header("location:../index.php");
    }
}
if (isset($_GET['admin'])) {
    if (isset($_SESSION['adminEmail']) && isset($_SESSION['admin_id'])) {
        unset($_SESSION['adminEmail']);
        unset($_SESSION['admin_id']);
        header("location:../index.php");
    }
}
if (isset($_GET['user'])) {

    if (isset($_SESSION['userEmail']) && isset($_SESSION['user_id'])) {
        unset($_SESSION['user_id']);
        unset($_SESSION['userEmail']);
    }
    header("location: ../index.php");
}