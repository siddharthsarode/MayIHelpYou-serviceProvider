                    <head>
                        <link rel="stylesheet" href="./css/admin.css">
                    </head>
                    <h1 class="heading">Dashboard</h1>
                    <div class="box-con">
                        <div class="box" id="box1">
                            <div class="text">
                                <h2>Total Users</h2>
                                <i class="fa-brands fa-youtube"></i>
                            </div>
                            <div class="numbers" onclick="display(1)">View details</div>
                        </div>
                        <div class="box" id="box2">
                            <div class="text">
                                <h2>Today's Order</h2>
                                <i class="fa-brands fa-youtube"></i>
                            </div>
                            <div class="numbers" onclick="display(2)">View Order</div>
                        </div>
                        <div class="box" id="box3">
                            <div class="text">
                                <h2>Working Emp</h2>
                                <i class="fa-solid fa-people-group"></i>
                            </div>
                            <div class="numbers" onclick="display(3)">View Employee</div>
                        </div>
                        <div class="box" id="box4">
                            <div class="text">
                                <h2>User Queries</h2>
                                <i class="fa-solid fa-comment"></i>
                            </div>
                            <div class="numbers" onclick="display(4)">View Queries</div>
                        </div>
                    </div>
                    <div id="show">
                        <h2 class="dash-content-heading head-1">Total Users</h2>
                        <table>
                            <thead class="thead-1">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require "../partials/_dbConnect.php";
                                // Fetch data from user table
                                $sql = "SELECT * FROM `user`";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                        <td>" . $row["user_id"] . "</td>
                        <td>" . $row["user_name"] . "</td>
                        <td>" . $row["user_email"] . "</td>
                        <td>" . $row["user_city"] . "</td>
                      </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4'>No users found</td></tr>";
                                }
                                $conn->close();
                                echo '</tbody>
</table>';

                                ?>
                    </div>
                    <script>
const display = (p) => {
    fetch(`./php/_getInfoBox(${p}).php`)
        .then(res => res.text())
        .then(data => {
            show.innerHTML = data;
        })
}
                    </script>