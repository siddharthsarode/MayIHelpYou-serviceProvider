<h2 class="dash-content-heading head-4">User Queries</h2>
<table>
    <thead class="thead-4">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require "../../partials/_dbConnect.php";
        // Fetch data from user table
        $sql = "SELECT * FROM `contact`";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["con_id"] . "</td>
                        <td>" . $row["con_user"] . "</td>
                        <td>" . $row["con_email"] . "</td>
                        <td>" . $row["con_status"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        $conn->close();
        echo '</tbody>
</table>';
        ?>