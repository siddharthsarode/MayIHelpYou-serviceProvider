<?php require "../partials/_dbConnect.php"; ?>

<body>
    <div class="add-service-container form-container" id="add-service">
        <button id="display-btn" class="operation-btn" style="margin: -3rem -0.1rem 0 0;float:right;">Service
            Info</button>
        <div class="service-box">
            <div class="form-box">
                <div class="form-heading">
                    <!-- <img src="../img/icons/adminDark.png" alt="Admin-img" class="admin-img"> -->
                    <h2 class="heading">Update Service</h2>
                </div>
                <form id="update-service-form" autocomplete="off">
                    <div class="form-element">
                        <label class="form-label" for="serviceName">Service Name</label>
                        <input class="form-input" type="text" name="serviceName" id="serviceName"
                            placeholder="Service Name" />
                        <input type="hidden" name="serviceId" id="serviceId">
                    </div>

                    <div class="form-element">
                        <label class="form-label" for="desc">Description</label>
                        <textarea class="form-input text-area" type="text" name="desc" id="desc" required></textarea>
                    </div>
                    <!-- two input tag side by side container -->
                    <div class="form-input-group">

                        <div class="form-element">
                            <label class="form-label" for="servicePrice">Price</label>
                            <input class="form-input" type="number" name="servicePrice" id="servicePrice"
                                placeholder="Price in Rs">
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="availability">Service Availability</label>
                            <select name="availability" class="form-input" id="availability">
                                <option value="">Select Service Availability</option>
                                <option value="yes">YES</option>
                                <option value="No">NO</option>
                            </select>
                            <input type="hidden" id="oldAvailability" class="form-input">
                        </div>

                    </div>
                    <div class="form-input-group">

                        <div class="form-element">
                            <label class="form-label" for="serviceDuration">Duration</label>
                            <select name="serviceDuration" class="form-input" id="serviceDuration">
                                <option value="">Select service duration</option>
                                <?php
                                $sql = "SELECT * FROM `duration`";
                                $res = $conn->query($sql);
                                if ($res) {
                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            echo '<option value="' . $row["duration_avg_time"] . '">' . $row["duration_avg_time"] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-input" id="duration">
                        </div>
                        <div class="form-element">
                            <label class="form-label" for="category">Service Category</label>
                            <select name="cate_id" class="form-input" id="newCategory">
                                <option value="">Select Service Category</option>
                                <?php
                                $sql = "SELECT * FROM `categories`";
                                $res = $conn->query($sql);
                                if ($res) {
                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            echo '<option value="' . $row["cate_id"] . '">' . $row["cate_name"] . '</option>';
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" class="form-input" id="categoryId">
                        </div>

                        <div class="form-element">
                            <label class="form-label" for="serviceImage">Upload Service Image </label>
                            <input class="input-file" type="file" accept="image/*" name="file" id="serviceImage"
                                placeholder="Service Duration" value="Upload file" />
                            <input type="hidden" id="img-path" class="form-input">
                        </div>
                    </div>

                    <div class="form-element">
                        <button class="form-input button submit-btn" id="submit">Update Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="table">
        <img class="close-img" id="close-table-btn" src="../img/icons/close.png">
        <div class="head">
            <h1>Service Info</h1>
        </div>
        <div class="content">
            <div class="search-bar">
                <input type="search" name="search" id="search-input" class="form-input" placeholder="search by name..">
            </div>
            <div class="table-box" style="overflow: scroll; height: 60vh;">
                <table border="1px">
                    <?php

                    $sql = $conn->prepare("SELECT * FROM `services`,`admin`,`categories`
                                    WHERE `admin`.`admin_id`=`services`.`service_admin_id`
                                    AND  `categories`.`cate_id`=`services`.`service_cate_id`");
                    $sql->execute();
                    $result = $sql->get_result();
                    ?>
                    <tr>
                        <th>Service Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Avg Duration</th>
                        <th>Availability</th>
                        <th>Create_at</th>
                        <th>Service Image</th>
                        <th>Category Name</th>
                        <th>Admin Name</th>
                        <th>Operation</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td class="searchServiceName"><?php echo $row['service_name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td><?php echo $row['avg_duration']; ?></td>
                        <td><?php echo $row['availability']; ?></td>
                        <td><?php echo $row['service_create_at']; ?></td>
                        <td><img src="<?php echo "../" . $row['image_path']; ?>" height="100px" width="100px"></td>
                        <td><?php echo $row['cate_name']; ?></td>
                        <td><?php echo $row['admin_name']; ?></td>
                        <td style="display: none;"><?php echo $row['service_id']; ?></td>
                        <td class="empId"><button>click</button></td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <script src="./js/_serviceUpdate.js"></script>
</body>