<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT * FROM `user`");
$sql->execute();
$result = $sql->get_result();
?>

<head>
    <style>
    th,
    td {
        padding: 2rem 1rem 2rem 1rem
    }
    </style>
</head>

<body>
    <div class="table-container">
        <div class="table-content">
            <div class="header">
                <h1>Register User's</h1>
                <input type="text" name="searchBar" id="userSearchBar" placeholder="Search by Employee Name...">
            </div>
            <div class="table-data">
                <div class="table" style="overflow:scroll;">
                    <table border="1px" cellspacing=0>
                        <tr>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>User Mobile No.</th>
                            <th>Register Date</th>
                            <th>City</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="searchUserName"><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['user_mobile_no']; ?></td>
                            <td><?php echo $row['user_create_at']; ?></td>
                            <td><?php echo $row['user_city']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/_userList.js"></script>
</body>