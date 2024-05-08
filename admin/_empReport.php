<?php require "../partials/_dbConnect.php"; ?>

<body>
    <div class="table-container">
        <div class="table-content">
            <div class="header">
                <h1>Employee Report</h1>
                <input type="text" name="searchBar" id="empSearchBar" placeholder="Search by Name...">
            </div>
            <div class="table-data">
                <div class="table">
                    <table border="1px" cellspacing=0>
                        <tr>
                            <th>Employee Name</th>
                            <th>Employee Email</th>
                            <th>Mobile No.</th>
                            <th>Address</th>
                            <th>Age</th>
                            <th>Adhar No.</th>
                            <th>Pan Card No.</th>
                            <th>Profile Picture</th>
                            <th>Adhar Image</th>
                            <th>Pan Card Image</th>
                        </tr>
                        <?php
                        $sql = $conn->prepare(("SELECT * FROM `employee`"));
                        $sql->execute();
                        $result = $sql->get_result();
                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="searchKey"><?php echo $row['emp_name']; ?></td>
                            <td><?php echo $row['emp_email']; ?></td>
                            <td><?php echo $row['emp_mobile_no']; ?></td>
                            <td><?php echo $row['emp_address']; ?></td>
                            <td><?php echo $row['emp_age']; ?></td>
                            <td><?php echo $row['adhar_card_no']; ?></td>
                            <td><?php echo $row['pan_card_no']; ?></td>
                            <td><img src="<?php echo $row['profile_picture']; ?>" height="100px" width="200px"></td>
                            <td><img src="<?php echo $row['adhar_image']; ?>" height="100px" width="200px"></td>
                            <td><img src="<?php echo $row['pan_card_image']; ?>" height="100px" width="200px"></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/_empReport.js"></script>
</body>