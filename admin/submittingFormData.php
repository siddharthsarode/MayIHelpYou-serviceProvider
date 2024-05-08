<?php
session_start();
// error_reporting(0);

include "../partials/_dbConnect.php";
include "../partials/_regularExp.php";

//php code to add new service
if (isset($_POST['service'])) {
    // error_reporting(0);

    if (isset($_FILES['file'])) {

        $name = trim($_POST['serviceName']);
        $desc = trim($_POST['desc']);
        $price = trim($_POST['servicePrice']);
        $duration = trim($_POST['serviceDuration']);
        $desc_len = strlen($desc);
        $cate_id = trim($_POST['cate_id']);

        $admin_id = $_SESSION['admin_id'];

        if (!preg_match(userNamePattern, $name) || empty($name)) {
            $userNameError = "* Invalid Service Name";
            echo $userNameError . "<br>";
        }
        if (!preg_match(pricePattern, $price) || empty($price)) {
            $priceError = "Min price must be 100 and don't start with zero";
            echo $priceError . "<br>";
        }

        if ($desc_len < 15) {
            $descError = "Description must have 15 character";
            echo $descError . "<br>";
        }

        if ($desc_len > 500) {
            $descError = "Description must be less than 500 character";
            echo $descError . "<br>";
        }

        if (empty($userNameError) && empty($priceError) && empty($descError) && empty($durationError) && !empty($duration) && !empty($cate_id)) {
            $date = date("d-m-yh-i_A");
            $fileUpload = new FileUpload($_FILES['file'], $date, "img/services/", "../img/services/");
            $fileUpload->upload();
            $result = $fileUpload->getResult();
            $path = $fileUpload->getStoragePath();
            $status = "Yes";
            if ($result) {
                $sql = $conn->prepare("INSERT INTO `services`(`service_id`,`service_name`,`description`,`price`,`avg_duration`,`availability`,`service_created_at`,`image_path`,`service_cate_id`,`service_admin_id`)
                                    VALUES(null,?,?,?,?,?,current_timestamp,?,?,?)");
                $sql->bind_param("ssssssss", $name, $desc, $price, $duration, $status, $path, $cate_id, $admin_id);
                $result1 = $sql->execute();
                if ($result1) {
                    echo "Service added successfully..!";
                } else {
                    echo "* Something missing";
                }
            } else {
                echo "* file could not uploaded..!";
            }
        }
    } else {
        echo "filled up the form..!";
    }
}

//php code to add new category
if (isset($_POST['category'])) {
    // error_reporting(0);
    function checkCate($cate)
    {
        global $conn;
        $sql = $conn->prepare("SELECT * FROM `categories` WHERE `cate_name`=?");
        $sql->bind_param("s", $cate);
        $sql->execute();
        $result = $sql->get_result();
        return $result->num_rows == 1 ? 1 : 0;
    }
    $cateName = trim($_POST['cateName']);
    if (preg_match(userNamePattern, $cateName) && !checkCate($cateName)) {
        $admin = $_SESSION['admin_id'];
        $sql = $conn->prepare("INSERT INTO `categories`(`cate_id`,`cate_name`,`cate_create_at`,`cate_admin_id`)
                            VALUES(null,?,current_timestamp,?)");
        $sql->bind_param("ss", $cateName, $admin);
        $res = $sql->execute();
        if ($res) {
            echo "Category added successfully..!";
        } else {
            echo "Sorry!category does not added!!";
        }
    } else {
        echo "* Something missing or category already exist..!";
    }
}

//php code to register new employee
if (isset($_POST['employeeRegistration'])) {
    // error_reporting(0);
    $empName = trim($_POST['empName']);
    $empEmail = trim($_POST['empEmail']);
    $mobile = trim($_POST['mobile']);
    $adr = trim($_POST['empAddress']);
    $age = trim($_POST['age']);
    $pass = trim($_POST['password']);
    $cate = $_POST['empCategory'];
    $adharNo = trim($_POST['adharNo']);
    $panNo = trim($_POST['panNo']);

    if (!preg_match(userNamePattern, $empName) || empty($empName)) {
        $nameError = "*Invalid Employee Name";
        echo $nameError . "<br>";
    }

    if (!preg_match(emailPattern, $empEmail) || empty($empEmail) || empExist($empEmail)) {
        $emailError = "*Invalid Email Address or email already exist..!";
        echo $emailError . "<br>";
    }

    if (!preg_match(mobilePattern, $mobile) || empty($mobile)) {
        $mobileError = "Mobile Number must be 10 digits";
        echo $mobileError . "<br>";
    }

    if (!preg_match(addressPattern, $adr) || empty($adr)) {
        $adrError = "*Address must containing 20 characters (includes a-z,A-Z,dot,comma,digits)*";
        echo $adrError . "<br>";
    }

    if ($age < 18 || $age > 65) {
        $ageError = "* Age cannot accepted *";
        echo $ageError . "<br>";
    }

    if (!preg_match(passwordPattern, $pass) || empty($pass)) {
        echo "!Password length min 5 and max 20 char,contains 0-9,a-z, A-Z,!,@,#,%,^";
        echo $passError . "<br>";
    }

    if (empty($cate)) {
        $cateError = "*Invalid Category*";
        echo $cateError . "<br>";
    }

    if (!preg_match(panCardPattern, $panNo) || empty($panNo)) {
        $panError = "*Invalid Pan card no.*";
        echo $panError . "<br>";
    }

    if (strlen($adharNo) > 12 || strlen($adharNo) < 12 || empty($adharNo)) {
        $adharError = "*Invalid Adhar card no.*";
        echo $adharError . "<br>";
    }

    if (
        empty($nameError) && empty($emailError) && empty($mobileError) &&
        empty($adrError) && empty($ageError) && empty($passError) &&
        empty($cateError) && empty($panError) && empty($adharError)
    ) {
        //file handling for submitted images
        if (isset($_FILES['adharCard']) && isset($_FILES['profile']) && isset($_FILES['panCard'])) {
            if ($_FILES['adharCard']['error'] !== UPLOAD_ERR_OK) {
                echo "Adhar Image cannot uploaded<br>";
            } else {
                if (isset($_FILES['adharCard'])) {
                    $fileUpload = new FileUpload($_FILES['adharCard'], $adharNo, "../img/adharCards/", "../img/adharCards/");
                    $fileUpload->upload();
                    $path1 = $fileUpload->getStoragePath();
                    $res1 = $fileUpload->getResult();
                    if ($res1) {
                        echo "Adhar card uploaded!!<br>";
                    }
                } else {
                    echo "*Please ! upload adhar card image *<br>";
                }
            }
            if ($_FILES['panCard']['error'] !== UPLOAD_ERR_OK) {
                echo "Pan card cannot uploaded!!<br>";
            } else {
                if (isset($_FILES['panCard'])) {
                    $fileUpload = new FileUpload($_FILES['panCard'], $panNo, "../img/panCards/", "../img/panCards/");
                    $fileUpload->upload();
                    $res2 = $fileUpload->getResult();
                    $path2 = $fileUpload->getStoragePath();
                    if ($res2) {
                        echo "Pan Card uploaded!!<br>";
                    } else {
                        echo "*Please ! upload Pan card image *<br>";
                    }
                } else {
                    echo "* Please ! upload Pan card image *<br>";
                }
            }

            if ($_FILES['profile']['error'] !== UPLOAD_ERR_OK) {
                echo "Profile picture cannot uploaded!!<br>";
            } else {
                if (isset($_FILES['profile'])) {
                    $fileUpload = new FileUpload($_FILES['profile'], $adharNo, "../img/user/", "../img/user/");
                    $fileUpload->upload();
                    $path3 = $fileUpload->getStoragePath();
                    $res3 = $fileUpload->getResult();
                    if ($res3) {
                        echo "Profile picture uploaded!!<br>";
                    } else {
                        echo "*Please ! upload profile image *<br>";
                    }
                } else {
                    echo "* Please ! upload profile image *<br>";
                }
            }
        } else {
            echo "*Please ,Select image files..";
        }
        if ($res1 == true && $res2 == true && $res3 == true) {
            $status = "new";
            $password = md5($pass);
            $sql = $conn->prepare("INSERT INTO `employee`(`emp_id`,`emp_name`,`emp_email`,`emp_mobile_no`,`emp_address`,`emp_age`,`adhar_card_no`,`pan_card_no`,`adhar_image`,`pan_card_image`,`emp_status`,`password`,`profile_picture`,`emp_admin_id`)VALUES(null,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sql->bind_param("sssssssssssss", $empName, $empEmail, $mobile, $adr, $age, $adharNo, $panNo, $path1, $path2, $status, $password, $path3, $_SESSION['admin_id']);
            $result = $sql->execute();
            if ($result) {
                echo "Employee Registered Successfully..!<br>";
            } else {
                echo "*Something problem for registration..!<br>";
            }

            $sql = $conn->prepare("SELECT `emp_id` FROM `employee` WHERE `emp_email`=?");
            $sql->bind_param("s", $empEmail);
            $sql->execute();
            $res = $sql->get_result();
            $column = $res->fetch_column();
            $empId = $column;

            $sql = $conn->prepare("INSERT INTO `category_employee`(`category_id`,`employee_id`,`emp_create_at`)VALUES(?,?,current_timestamp)");
            $sql->bind_param("ss", $cate, $empId);
            $result3 = $sql->execute();
            if ($result3) {
                echo "Record inserted";
            }
        } else {
            echo "* Some files could not uploaded..!";
        }
    }
}

//employee registration ends here

//sending requested data
if (isset($_POST['fetch_for_update'])) {
    $emp_id = $_POST['emp_id'];
    $sql = $conn->prepare("SELECT * FROM `employee`,`category_employee`
                                    WHERE `employee`.`emp_id`=`category_employee`.`employee_id`
                                    AND `emp_id`=?");
    $sql->bind_param("s", $emp_id);
    $sql->execute();
    $result1 = $sql->get_result();
    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
    }
    $data = json_encode($row);
    print_r($data);
}

//php script to update the form data sended through fetch request
if (isset($_POST['employeeUpdate'])) {

    $empName = trim($_POST['empName']);
    $empEmail = trim($_POST['empEmail']);
    $mobile = trim($_POST['mobile']);
    $adr = trim($_POST['empAddress']);
    $age = trim($_POST['age']);
    $newCate = trim($_POST['empCategory']);
    $adharNo = trim($_POST['adharNo']);
    $panNo = trim($_POST['panNo']);
    $empId = $_POST['empId'];
    $newEmpStatus = $_POST['empStatus'];
    $oldEmpStatus = $_POST['oldEmpStatus'];
    $oldCate = $_POST['oldCategory'];
    /*
    formData.append("empStatus",empStatus.value);
    formData.append("oldEmpStatus",empOldStatus.value);
    formData.append("oldCategory",oldCategory.value);
    */

    if (isset($newEmpStatus) && !empty($newEmpStatus)) {
        $empStatus = $newEmpStatus;
    } else {
        $empStatus = $oldEmpStatus;
    }

    if (isset($newCate) && !empty($newCate)) {
        $cate = $newCate;
    } else {
        $cate = $oldCate;
    }

    $adharPath = trim($_POST['adharImgPath']);
    $profilePath = trim($_POST['profileImgPath']);
    $panPath = trim($_POST['panImgPath']);

    if (!preg_match(userNamePattern, $empName) || empty($empName)) {
        $nameError = "*Invalid Employee Name";
        echo $nameError . "<br>";
    }

    if (!preg_match(emailPattern, $empEmail) || empty($empEmail)) {
        $emailError = "*Invalid Email Address";
        echo $emailError . "<br>";
    }

    if (!preg_match(mobilePattern, $mobile) || empty($mobile)) {
        $mobileError = "Mobile Number must be 10 digits";
        echo $mobileError . "<br>";
    }

    if (!preg_match(addressPattern, $adr) || empty($adr)) {
        $adrError = "*Address must containing 20 characters (includes a-z,A-Z,dot,comma,digits)*";
        echo $adrError . "<br>";
    }

    if ($age < 18 || $age > 65 || empty($age)) {
        $ageError = "* Age cannot accepted *";
        echo $ageError . "<br>";
    }

    if (empty($cate)) {
        $cateError = "*Invalid Category*";
        echo $cateError . "<br>";
    }

    if (!preg_match(panCardPattern, $panNo) || empty($panNo)) {
        $panError = "*Invalid Pan card no.*";
        echo $panError . "<br>";
    }

    if (strlen($adharNo) > 12 || strlen($adharNo) < 12 || empty($adharNo)) {
        $adharError = "*Invalid Adhar card no.*";
        echo $adharError . "<br>";
    }

    if (
        empty($nameError) && empty($emailError) && empty($mobileError) && empty($adrError)
        && empty($ageError) && empty($cateError) && empty($panError) && empty($adharError)
    ) {

        if (isset($_FILES['adharCard'])) {
            echo "adhar uploaded";
            if ($_FILES['adharCard']['error'] !== UPLOAD_ERR_OK) {
                echo "Adhar card cannot uploaded!!<br>";
            } else {
                if (unlink($adharPath)) {
                    $fileUpload = new FileUpload($_FILES['adharCard'], $adharNo, "../img/adharCards/", "../img/adharCards/");
                    $fileUpload->upload();
                    $adharUploadResult = $fileUpload->getResult();
                    $adharNewPath = $fileUpload->getStoragePath();
                    if ($adharUploadResult) {
                        echo "Adhar Card uploaded!!<br>";
                    } else {
                        echo "*Adhar card image could not uploaded*<br>";
                    }
                } else {
                    echo "*Something error in Adhar card uploading !!";
                }
            }
        }

        if (isset($_FILES['panCard'])) {
            echo "Pan uploaded";
            if ($_FILES['panCard']['error'] !== UPLOAD_ERR_OK) {
                echo "Pan card cannot uploaded!!<br>";
            } else {
                if (unlink($panPath)) {
                    $fileUpload = new FileUpload($_FILES['panCard'], $panNo, "../img/panCards/", "../img/panCards/");
                    $fileUpload->upload();
                    $panCardNewPath = $fileUpload->getStoragePath();
                    $panUploadResult = $fileUpload->getResult();
                    if ($panUploadResult) {
                        echo "Pan Card uploaded!!<br>";
                    } else {
                        echo "*Pan card image could not uploaded*<br>";
                    }
                } else {
                    echo "*Something error in pan card uploading !!";
                }
            }
        }

        if (isset($_FILES['profile'])) {
            echo "profile uploaded";
            if ($_FILES['profile']['error'] !== UPLOAD_ERR_OK) {
                echo "Profile picture cannot uploaded!!<br>";
            } else {
                if (unlink($profilePath)) {
                    $fileUpload = new FileUpload($_FILES['profile'], $adharNo, "../img/user/", "../img/user/");
                    $fileUpload->upload();
                    $profileUploadResult = $fileUpload->getResult();
                    $profileNewPath = $fileUpload->getStoragePath();
                    if ($profileUploadResult) {
                        echo "Profile picture uploaded!!<br>";
                    } else {
                        echo "*Profile Image could not uploaded *<br>";
                    }
                } else {
                    echo "*Something error in profile image uploading !!";
                }
            }
        }

        if (isset($_FILES['profile']) && $profileUploadResult == true) {
            $profileExactPath = $profileNewPath;
        } else {
            $profileExactPath = $profilePath;
        }

        if (isset($_FILES['adharCard']) && $adharUploadResult == true) {
            $adharExactPath = $adharNewPath;
        } else {
            $adharExactPath = $adharPath;
        }

        if (isset($_FILES['panCard']) && $panUploadResult == true) {
            $panExactPath = $panCardNewPath;
        } else {
            $panExactPath = $panPath;
        }

        if (!empty($adharExactPath) && !empty($panExactPath) && !empty($profileExactPath)) {

            $sql = $conn->prepare("UPDATE `employee`,`category_employee` 
                                    SET 
                                        `emp_name`=?,
                                        `emp_email`=?,
                                        `emp_mobile_no`=?,
                                        `emp_address`=?,
                                        `emp_age`=?,
                                        `adhar_card_no`=?,
                                        `pan_card_no`=?,
                                        `adhar_image`=?,
                                        `pan_card_image`=?,
                                        `emp_status`=?,
                                        `profile_picture`=?,
                                        `category_id`=?
                                    WHERE 
                                        `employee`.`emp_id`=`category_employee`.`employee_id`
                                    AND
                                        `emp_id`=?");

            $sql->bind_param("sssssssssssss", $empName, $empEmail, $mobile, $adr, $age, $adharNo, $panNo, $adharExactPath, $panExactPath, $empStatus, $profileExactPath, $cate, $empId);
            $result = $sql->execute();

            if ($result) {
                echo "Record Updated Successfully..!";
            } else {
                echo "Details Cannot updated";
            }
        }
    }
}

//delete the requested record from database as per admin request
if (isset($_POST['remove'])) {
    $empId = $_POST['empId'];
    if (!empty($empId) && isset($empId)) {
        $status = "Not Working";
        $sql = $conn->prepare("UPDATE `employee` SET `emp_status`=? WHERE `emp_id`=?");
        $sql->bind_param("ss", $status, $empId);
        $result = $sql->execute();
        if ($result) {
            echo "Employee Removed from Working list and status updated to 'Not Working'";
        } else {
            echo "Employee could not removed ,please try again.";
        }
    }
}


//send email via php mail function

if (isset($_POST['sendMail'])) {
    $customerEmail = trim($_POST['mail']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $header = "From:gopalsadavarte555@gmail.com";
    $operation = $_POST['operation'];

    if (empty($subject) || !preg_match(addressPattern, $subject)) {
        $subError = "Subject length have min 20 char's..!";
        echo $subError;
    }

    if (empty($message)) {
        $messageError = "Message Not Should Empty..!";
        echo $messageError;
    }

    if (empty($subError) && empty($messageError)) {
        $result = mail($customerEmail, $subject, $message, $header);

        if ($result) {
            echo "Mail Send Successfully..!";
        } else {
            echo "Network Problem, Mail cannot send..";
        }

        if ($operation == "accept")
            $status = "running";
        else
            $status = "cancel";

        if ($result) {
            $sql = $conn->prepare("UPDATE `user_order` 
                                    SET `order_status`= ? 
                                  WHERE `user_order`.`order_id`=`order_to_order_details`.`ord_id`
                                    AND  `order_details`.`order_details_id`=`order_to_order_details`.`ord_details_id`
                                    AND `customer_email`=?");
            $sql->bind_param("ss", $status, $customerEmail);
            $update = $sql->execute();
            if ($update) {
                echo "Order Status Updated..";
            } else {
                echo "Order Status Cannot Updated";
            }
        }
    }
}


if (isset($_POST['updateCategory'])) {
    $cateId = $_POST['categoryId'];
    $cateName = trim($_POST['categoryName']);

    if (empty($cateName)) {
        $cateEmptyError = "Category Name not should be empty..";
        echo $cateEmptyError;
    }

    if (!preg_match(userNamePattern, $cateName)) {
        $catePError = "Category Name Contains only lower and uppercase letter's..";
        echo $catePError;
    }

    if (empty($catePError) && empty($cateEmptyError)) {
        $sql = $conn->prepare("UPDATE `categories` SET `cate_name`=?,`cate_create_at`=current_timestamp,`cate_admin_id`=? WHERE `cate_id`=?");
        $sql->bind_param("sss", $cateName, $_SESSION['admin_id'], $cateId);
        $result = $sql->execute();
        if ($result) {
            echo "Category Updated Successfully..";
        } else {
            echo "Category cannot updated";
        }
    }
}


//service data fetch for the admin request
if (isset($_POST['service_fetch_request'])) {
    $serviceId = trim($_POST['serviceId']);
    $sql = $conn->prepare("SELECT * FROM `services`,`categories`,`admin`
                        WHERE `categories`.`cate_id`=`services`.`service_cate_id`
                        AND    `admin`.`admin_id`=`services`.`service_admin_id`
                        AND   `service_id`=?");
    $sql->bind_param("s", $serviceId);
    $sql->execute();
    $result = $sql->get_result();
    $row = $result->fetch_assoc();
    $data = json_encode($row);
    print_r($data);
}


//updating service here
if (isset($_POST['updateService'])) {
    $serviceId = $_POST['serviceId'];
    $serviceName = trim($_POST['serviceName']);
    $desc = trim($_POST['description']);
    $price = trim($_POST['servicePrice']);
    $oldImgPath = trim($_POST['oldImg']);
    $oldAvailable = trim($_POST['oldAvailable']);
    $newAvailable = trim($_POST['newAvailability']);
    $oldDuration = $_POST['oldDuration'];
    $newDuration = trim($_POST['newDuration']);
    $oldCate = $_POST['oldCategory'];
    $newCate = $_POST['newCategory'];


    $path = "../" . $oldImgPath;
    if (isset($_FILES['file'])) {
        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            echo "New Service Image cannot upload";
        } else {
            if (unlink($path)) {
                $date = date("d-m-yh-i_A");
                $newImage = new FileUpload($_FILES['file'], $date, "img/services/", "../img/services/");
                $newImage->upload();
                $result = $newImage->getResult();
                $newImgPath = $newImage->getStoragePath();

                if ($result) {
                    echo "Image uploaded successfully..";
                } else {
                    echo "Image cannot upload";
                }
            }
        }
    }

    $desc_len = strlen($desc);
    $admin_id = $_SESSION['admin_id'];

    if (!preg_match(userNamePattern, $serviceName) || empty($serviceName)) {
        $serviceNameError = "* Invalid Service Name";
        echo $serviceNameError . "       ";
    }
    if (!preg_match(pricePattern, $price) || empty($price)) {
        $priceError = "Min price must be 100 and don't start with zero";
        echo $priceError . "     ";
    }

    if ($desc_len < 15) {
        $descError = "Description must have 15 character";
        echo $descError . "     ";
    }

    if ($desc_len > 500) {
        $descError = "Description must be less than 500 character";
        echo $descError . "     ";
    }

    if (isset($newDuration) && !empty($newDuration)) {
        $duration = $newDuration;
    } else {
        $duration = $oldDuration;
    }

    if (isset($newCate) && !empty($newCate)) {
        $category = $newCate;
    } else {
        $category = $oldCate;
    }

    if (isset($newImgPath) && !empty($newImgPath)) {
        $exactPath = $newImgPath;
    } else {
        $exactPath = $oldImgPath;
    }

    if (isset($newAvailable) && !empty($newAvailable)) {
        $available = $newAvailable;
    } else {
        $available = $oldAvailable;
    }

    if (empty($serviceNameError) && empty($priceError) && empty($descError)) {
        $sql = $conn->prepare("UPDATE `services` 
                            SET `service_name`=?,
                                `description`=?,
                                `price`=?,
                                `avg_duration`=?,
                                `availability`=?,
                                `service_create_at`=current_timestamp,
                                `image_path`=?,
                                `service_cate_id`=?,
                                `service_admin_id`=?
                            WHERE
                                `service_id`=?");
        $sql->bind_param("sssssssss", $serviceName, $desc, $price, $duration, $available, $exactPath, $category, $admin_id, $serviceId);
        $updateResult = $sql->execute();
        if ($updateResult) {
            echo "Record Updated Successfully..";
        } else {
            echo "Record cannot updated";
        }
    }
}



//admin registration start here
if (isset($_POST['admin-sign-up'])) {
    $adminName = trim($_POST['adminName']);
    $email = trim($_POST['adminEmail']);
    $password = trim($_POST['adminPassword']);

    if (!preg_match(userNamePattern, $adminName) || empty($adminName)) {
        $nameError = "Please,Enter valid admin name..  ";
        echo $nameError;
    }

    if (!preg_match(emailPattern, $email) || empty($email) || adminExist($email)) {
        $emailError = "*Invalid Email! or Admin already exist!  ";
        echo $emailError;
    }

    if (!preg_match(passwordPattern, $password) || empty($password)) {
        $passwordError = "Password should contains A-Z or a-z or 0-9 or !,@,#,$,%,^ and min 5 char and max 15 char";
        echo $passwordError;
    }

    if (empty($nameError) && empty($emailError) && empty($passwordError)) {
        $sql = $conn->prepare("INSERT INTO `admin`(`admin_id`,`admin_name`,`admin_email`,`admin_password`)
                            VALUES(null,?,?,?)");
        $sql->bind_param("sss", $adminName, $email, $password);
        $result = $sql->execute();
        if ($result) {
            echo "Admin Registered Successfully..";
        } else {
            echo "Something Error,Try again";
        }
    }
}



//Assign new category to employee form submission start here
if (isset($_POST['insertToCategoryEmployee'])) {
    $empId = $_POST['assignToEmail'];
    $cateId = $_POST['assignNewCateId'];

    if (empty($empId)) {
        $empIdError = "*Please,Select Email id";
        echo $empIdError;
    }

    if (empty($cateId)) {
        $cateIdError = "*Please,Select Category";
        echo $cateIdError;
    }

    $sql = $conn->prepare("SELECT * FROM `category_employee` WHERE `employee_id`=? AND `category_id`=? ORDER BY `employee_id` DESC LIMIT 1");
    $sql->bind_param("ss", $empId, $cateId);
    $sql->execute();
    $result = $sql->get_result();
    if ($result->num_rows == 1) {
        $cateExistError = "*Category already assign to this employee..";
        echo $cateExistError;
    }

    if (empty($empIdError) && empty($cateIdError) && empty($cateExistError)) {
        $sql = $conn->prepare("INSERT INTO `category_employee`(`category_id`,`employee_id`,`emp_create_at`)
                                VALUES(?,?,current_timestamp)");
        $sql->bind_param("ss", $cateId, $empId);
        $result = $sql->execute();
        if ($result) {
            echo "Record Inserted Successfully...";
        } else {
            echo "*Something Problem,Record does'nt inserted";
        }
    }
}


if (isset($_POST['delete-from-category_employee'])) {
    $empId = $_POST['delete-emp-email'];
    if (empty($empId)) {
        $empIdError = "*Please,Select Email for deletion";
        echo $empIdError;
    }

    if (empty($empIdError)) {
        $sql = $conn->prepare("DELETE FROM `category_employee` WHERE `employee_id`=?");
        $sql->bind_param("s", $empId);
        $result = $sql->execute();
        if ($result) {
            echo "All Records are Deleted..";
        } else {
            echo "*Something Error,Try again.";
        }
    }
}


//sending email to user as per user query
if (isset($_POST['userQuery'])) {
    $userEmail = $_POST['userQueryEmail'];
    $subject = trim($_POST['userQuerySubject']);
    $message = trim($_POST['userQueryMessage']);

    if (empty($subject)) {
        $subjectError = "* Subject not should empty..";
        echo $subjectError;
    }

    if (empty($message)) {
        $messageError = "* Message not should empty..";
        echo $messageError;
    }

    if (empty($subjectError) && empty($messageError)) {
        $header = "From:gopalsadavarte555@gmail.com";
        if (mail($userEmail, $subject, $message, $header)) {
            echo "Mail Send Successfully..";
            $status = "Replied";
            $sql = $conn->prepare("UPDATE `contact` SET `con_status`=? WHERE `con_email`=?");
            $sql->bind_param("ss", $status, $userEmail);
            $res = $sql->execute();
        } else {
            echo "Mail could not send.";
        }
    }
}