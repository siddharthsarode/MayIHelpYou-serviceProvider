<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT * FROM `categories`");
$sql->execute();
$res = $sql->get_result();

$sql = $conn->prepare("SELECT * FROM `employee`");
$sql->execute();
$result = $sql->get_result();
?>

<body>
    <div class="employee-operations">
        <button id="display-btn" class="operation-btn">Employee Info</button>
        <button class="operation-btn" id="set-category">Set Category</button>
    </div>
    <div class="add-service-container form-container container" id="add-service">
        <div class="service-box">
            <div class="form-box">
                <div class="form-heading">
                    <img src="../img/icons/adminDark.png" alt="Admin-img" style="margin:-2rem 0 0 0" class="admin-img">
                    <h2 class="heading">Employee Update</h2>
                </div>
                <form id="emp-update-form" autocomplete="off">
                    <div class="form-input-group">
                        <div class="form-element">
                            <input type="hidden" class="form-input" name="emp_id" id="empId">
                            <label class="form-label" for="empName">Name</label>
                            <input class="form-input" type="text" name="empName" id="empName"
                                placeholder="Employee Name" required />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="empEmail">Email</label>
                            <input class="form-input" type="email" name="empEmail" id="empEmail"
                                placeholder="Employee Email" required />
                        </div>
                    </div>
                    <div class="form-input-group">
                        <div class="form-element">
                            <label class="form-label" for="mobile">Mobile No.</label>
                            <input class="form-input" type="number" name="mobile" id="mobile"
                                placeholder="Employee Mobile no." required />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="empAddress">Address</label>
                            <input class="form-input" type="text" name="empAddress" id="empAddress"
                                placeholder="Employee Address" required />
                        </div>
                    </div>
                    <div class="form-input-group">
                        <div class="form-element">
                            <label class="form-label" for="empAge">Age</label>
                            <input class="form-input" type="number" name="empAge" id="empAge" placeholder="Employee Age"
                                required />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="empStatus">Status</label>
                            <select name="empStatus" class="form-input" id="empStatus">
                                <option value="">Select Employee status</option>
                                <option value="new">New</option>
                                <option value="absent">absent</option>
                                <option value="present">present</option>
                            </select>
                            <input type="hidden" name="oldStatus" id="oldStatus" class="form-input">
                        </div>
                    </div>
                    <div class="form-input-group">
                        <div class="form-element">
                            <label class="form-label" for="empCategory">Category</label>
                            <select name="empCategory" class="form-input" id="empCategory">
                                <option value="">Select employee category</option>
                                <?php
                                if ($res) {
                                    while ($row = $res->fetch_assoc()) {
                                        echo "<option value='$row[cate_id]'>$row[cate_name]</option>";
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" name="oldCategory" id="oldCategory" class="form-input">
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="empProfile">Profile picture</label>
                            <input type="file" accept="image/*" name="empProfile" id="empProfile" />
                            <input type="hidden" name="profileImgPath" id="empProfileImgPath" class="form-input" />
                        </div>
                    </div>
                    <!-- two input tag side by side container -->
                    <div class="form-input-group">
                        <div class="form-element">
                            <label class="form-label" for="adharNo">Adhar Card No.</label>
                            <input class="form-input" type="number" name="adharNo" id="adharNo"
                                placeholder="Employee Adhar no." />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="adharImage">Upload Adhar Image </label>
                            <input class="input-file" type="file" accept="image/*" name="adharImage" id="adharImage"
                                value="Upload file" />
                            <input type="hidden" id="adharImagePath" class="form-input">
                        </div>
                    </div>
                    <!-- two input tag side by side container -->
                    <div class="form-input-group">
                        <div class="form-element">
                            <label class="form-label" for="panNo">Pan Card No.</label>
                            <input class="form-input" type="text" name="panNo" id="panNo"
                                placeholder="Employee Pan card no." />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="panCardImage">Upload Pan Card Image </label>
                            <input class="input-file" type="file" accept="image/*" name="panCardImage" id="panCardImage"
                                value="Upload file" />
                            <input type="hidden" id="panImagePath" class="form-input" />
                        </div>
                    </div>
                    <div class="form-input-group">
                        <div class="form-element">
                            <button class="form-input button submit-btn" id="update">Update</button>
                        </div>
                        <div class="form-element">
                            <button class="form-input button submit-btn" style="color: white; background-color: red;"
                                id="delete">Delete</button>
                        </div>
                    </div>
                    <div class="service-response">
                        <span id="response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="table">
        <img class="close-img" id="close-table-btn" src="../img/icons/close.png">
        <div class="head">
            <h1>Employee Report</h1>
        </div>
        <div class="content">
            <div class="search-bar">
                <input type="search" name="search" id="search-input" class="form-input" placeholder="search by name..">
            </div>
            <div class="table-box" style="overflow:scroll;">
                <table>
                    <tr>
                        <!--emp_id	emp_name	email	mobile_no	emp_address	emp_age	adhar_card_no	pan_card_no	adhar_image	pan_card_image	status	password profile_picture-->
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Address</th>
                        <th>Age</th>
                        <th>Adhar No.</th>
                        <th>Pan No.</th>
                        <th>Profile Image</th>
                        <th>Adhar Image</th>
                        <th>Pan card Image</th>
                        <th>link</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr class=" . "searchRow" . ">
                                    <td>$row[emp_name]</td>
                                    <td>$row[emp_email]</td>
                                    <td>$row[emp_mobile_no]</td>
                                    <td>$row[emp_address]</td>
                                    <td>$row[emp_age]</td>
                                    <td>$row[adhar_card_no]</td>
                                    <td>$row[pan_card_no]</td>
                                    <td><img src='$row[profile_picture]' class='profile-img' alt='$row[emp_name]' height='50px'/></td>
                                    <td><img src='$row[adhar_image]' class='adhar-img' alt='adhar image' height='50px'/></td>
                                    <td><img src='$row[pan_card_image]' class='pan-img' alt='Pan card'height='50px'/></td>
                                    <td style=" . "display:none;" . ">$row[emp_id]</td>
                                    <td class=" . "empId" . "><button>click</button></td>
                                </tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="form-container received-order-container" id="login-container">
        <div class="form-box">
            <img class="close-img" id="close-form-box" src="../img/icons/close.png" style="position:relative;top:2rem;">
            <div class="form-heading">
                <!-- <img src="../img/icons/adminDark.png" alt="Admin-img" class="admin-img" id="admin-img"> -->
                <h3 id="adminHeading">Assign Category</h3>
            </div>
            <form id="assign-category-form">
                <div class="form-element">
                    <label for="empEmail" class="form-label">Employee Email</label>
                    <select id="assignEmpEmail" class="form-input">
                        <option value="">Select Employee Email</option>
                        <?php
                        $sql = $conn->prepare("SELECT * FROM `employee`");
                        $sql->execute();
                        $result = $sql->get_result();
                        while ($row = $result->fetch_assoc()) : ?>
                        <option value="<?php echo $row['emp_id']; ?>"><?php echo $row['emp_email']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-element">
                    <label class="form-label" for="newCategory">Employee Category</label>
                    <select id="newCategory" class="form-input">
                        <option value="">Select Employee Category</option>
                        <?php
                        $sql = $conn->prepare("SELECT * FROM `categories`");
                        $sql->execute();
                        $res = $sql->get_result();
                        while ($row = $res->fetch_assoc()) : ?>
                        <option value="<?php echo $row['cate_id']; ?>"><?php echo $row['cate_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-input-group">
                    <div class="form-element">
                        <button class="form-input button submit-btn" id="add-cate">Register Now</button>
                    </div>
                    <div class="form-element">
                        <button class="form-input button submit-btn" id="delete-from-cate-emp"
                            style="color:white;background-color:red">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!---- javascript file link here---->
    <script src="./js/_empUpdate.js"></script>
</body>