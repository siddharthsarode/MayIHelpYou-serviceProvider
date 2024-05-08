<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT * FROM `categories`,`category_employee`,`employee`,`admin` 
                            WHERE `categories`.`cate_id`=`category_employee`.`category_id` 
                            AND `employee`.`emp_id`=`category_employee`.`employee_id` 
                            AND `admin`.`admin_id`=`employee`.`emp_admin_id` ORDER BY `cate_name` ASC");
$sql->execute();
$result = $sql->get_result();
?>

<head>
    <style>
    td {
        padding: 2rem 1rem 2rem 1rem
    }
    </style>
</head>

<body>
    <div class="table-container">
        <div class="table-content">
            <div class="header">
                <h1>Employee List by Category</h1>
                <input type="text" name="searchBar" id="empSearchBar" placeholder="Search by Employee Name...">
            </div>
            <div class="table-data">
                <div class="table" style="overflow:scroll;">
                    <table border="1px" cellspacing=0>
                        <tr>
                            <th>Emp Name</th>
                            <th>Emp Email</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Registered Date</th>
                            <th>Admin Name</th>
                            <th>Category Name</th>
                            <th>Operation</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="searchEmployeeName"><?php echo $row['emp_name']; ?></td>
                            <td><?php echo $row['emp_email']; ?></td>
                            <td><?php echo $row['emp_address']; ?></td>
                            <td><?php echo $row['emp_create_at']; ?></td>
                            <td><?php echo $row['admin_name']; ?></td>
                            <td><?php echo $row['cate_name']; ?></td>
                            <td class="empStatus"><?php echo $row['emp_status']; ?></td>
                            <td><button class="accept-order-btn">Assign</button></td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/_empByService.js"></script>
</body>