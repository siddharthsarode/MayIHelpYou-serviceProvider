<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT * FROM `services`,`admin`,`categories`
                              WHERE `admin`.`admin_id`=`services`.`service_admin_id`
                               AND  `categories`.`cate_id`=`services`.`service_cate_id`");
$sql->execute();
$result = $sql->get_result();
?>

<body>
    <div class="table-container">
        <div class="table-content">
            <div class="header">
                <h1>Service List</h1>
                <input type="text" name="searchBar" id="serviceSearchBar" placeholder="Search by Service Name...">
            </div>
            <div class="table-data">
                <div class="table" style="overflow:scroll;">
                    <table border="1px" cellspacing=0>
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
                            <td><img src="<?php echo "../" . $row['image_path']; ?>" style="cursor: pointer;"
                                    class="original-img" data-link="<?php echo $row['service_id']; ?>"></td>
                            <td class="searchCateName"><?php echo $row['cate_name']; ?></td>
                            <td><?php echo $row['admin_name']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="image-container received-order-container" id="image-content" style="display: none;">
        <div class="hidden-img">
            <?php
            $sql = $conn->prepare("SELECT `image_path`,`service_id` FROM `services`");
            $sql->execute();
            $result = $sql->get_result();
            while ($row = $result->fetch_assoc()) :
            ?>
            <div class="image-list" style="display: none;" data-target="<?php echo $row['service_id']; ?>">
                <div class="header">
                    <img src="../img/icons/close.png" id="close-img" class="close-btn"
                        style="float:right;margin-top:2rem;">
                    <h1 class="heading" style="text-align: center;" id="serviceImageName"></h1>
                </div>
                <img src="<?php echo "../" . $row['image_path']; ?>" height="500px">
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script src="./js/_serviceList.js"></script>
</body>