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
        require "../../partials/_dbConnect.php";
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