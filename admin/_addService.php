<?php require "../partials/_dbConnect.php"; ?>

<body>
    <div class="add-service-container form-container" id="add-service">
        <div class="service-box">
            <div class="form-box">
                <div class="form-heading">
                    <!-- <img src="../img/icons/adminDark.png" alt="Admin-img" class="admin-img"> -->
                    <h2 class="heading">Add Service</h2>
                </div>
                <form id="add-service-form" autocomplete="off">
                    <div class="form-element">
                        <label class="form-label" for="serviceName">Service Name</label>
                        <input class="form-input" type="text" name="serviceName" id="serviceName"
                            placeholder="Service Name" />
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
                            <label class="form-label" for="serviceDuration">Duration</label>
                            <select name="serviceDuration" class="form-input" id="serviceDuration">
                                <option value="">Select service duration</option>
                                <?php
                                $sql = "SELECT * FROM duration";
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
                        </div>
                    </div>

                    <div class="form-input-group">
                        <div class="form-element">
                            <label class="form-label" for="category">Service Category</label>
                            <select name="cate_id" class="form-input" id="category">
                                <option value="">Select Service Category</option>
                                <?php
                                $sql = "SELECT * FROM categories";
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

                        </div>

                        <div class="form-element">
                            <label class="form-label" for="serviceImage">Upload Service Image </label>
                            <input class="input-file" type="file" accept="image/*" name="file" id="serviceImage"
                                placeholder="Service Duration" value="Upload file" required />
                        </div>
                    </div>

                    <div class="form-element">
                        <button class="form-input button submit-btn" id="submit">Add Now</button>
                    </div>
                    <div class="service-response">
                        <span id="response"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/_addService.js"></script>
</body>