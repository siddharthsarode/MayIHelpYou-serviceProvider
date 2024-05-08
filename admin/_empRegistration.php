<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT * FROM `categories`");
$sql->execute();
$res = $sql->get_result();
?>

<body>
    <div class="add-service-container form-container container" id="add-service">
        <div class="service-box" id="emp-add">
            <div class="form-box">
                <div class="form-heading">
                    <img src="../img/icons/adminDark.png" alt="Admin-img" style="margin:-2rem 0 0 0" class="admin-img">
                    <h2 class="heading">Employee Registration</h2>
                </div>
                <form id="emp-registration-form" autocomplete="off">
                    <div class="form-input-group">
                        <div class="form-element">
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
                                placeholder="Employee Mobile no." />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="empAge">Age</label>
                            <input class="form-input" type="number" name="empAge" id="empAge"
                                placeholder="Employee Age" />
                        </div>
                    </div>
                    <div class="form-input-group">
                        <div class="form-element">
                            <label class="form-label" for="empAddress">Address</label>
                            <input class="form-input" type="text" name="empAddress" id="empAddress"
                                placeholder="Employee Address" />
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="empPassword">Password</label>
                            <input class="form-input" type="text" name="empPassword" id="empPassword"
                                placeholder="Employee Password" />
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
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="empProfile">Profile picture</label>
                            <input type="file" accept="image/*" name="empProfile" id="empProfile" />
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
                                value="Upload file" required />
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
                                value="Upload file" required />
                        </div>
                    </div>
                    <div class="form-element">
                        <button class="form-input button submit-btn" id="submit">Submit</button>
                    </div>
                    <div class="service-response">
                        <span id="response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/_empRegister.js"></script>
</body>