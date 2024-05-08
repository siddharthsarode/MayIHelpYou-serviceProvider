<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT * FROM `categories`,`admin` WHERE `admin`.`admin_id`=`categories`.`cate_admin_id`");
$sql->execute();
$result = $sql->get_result();
?>

<head>
    <style>
    th,
    td {
        padding: 1.5rem 0 1.5rem 0;
    }
    </style>
</head>

<body>
    <div class="table-container">
        <div class="table-content">
            <div class="header">
                <h1>Category List</h1>
                <input type="text" name="searchBar" id="cateSearchBar" placeholder="Search by Category Name...">
            </div>
            <div class="table-data">
                <div class="table">
                    <table border="1px" cellspacing=0>
                        <tr>
                            <th>Category Name</th>
                            <th>Time & Date</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                            <th>operation</th>
                        </tr>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td class="searchValue"><?php echo $row['cate_name']; ?></td>
                            <td><?php echo $row['cate_create_at']; ?></td>
                            <td><?php echo $row['admin_name']; ?></td>
                            <td><?php echo $row['admin_email']; ?></td>
                            <td style="display: none;"><?php echo $row['cate_id']; ?></td>
                            <td><button class="accept-order-btn update">Update</button></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container received-order-container" id="update-category" style="bottom: -10rem;">
        <div class="service-box">
            <div class="form-box">
                <div class="form-heading">
                    <h2 class="heading">Update Category</h2>
                    <img src="../img/icons/close.png" id="close-img" style="position:relative;left:18%;">
                </div>
                <form id="add-category-form" autocomplete="off">
                    <div class="form-element">
                        <label class="form-label" for="serviceName">Category Name</label>
                        <input class="form-input" type="text" name="serviceName" id="categoryName"
                            placeholder="Category Name" />
                    </div>
                    <div class="form-element">
                        <button class="form-input button submit-btn" id="submit">Update Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="./js/_categoryList.js"></script>
</body>