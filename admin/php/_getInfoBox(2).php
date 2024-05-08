<?php
// require "../partials/_dbConnect.php";
require "../../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT 
                            `customer_name`,
                            `customer_email`,
                            `customer_city`,
                            `service_name`,
                            `order_status`,
                            `order_id`
                        FROM 
                            `order_details`,
                            `order_to_order_details`,
                            `services`,
                            `user_order`
                        WHERE 
                            `services`.`service_id`=`order_details`.`order_service_id` 
                        AND 
                            `user_order`.`order_id`=`order_to_order_details`.`ord_id` 
                        AND 
                            `order_details`.`order_details_id`=`order_to_order_details`.`ord_details_id`
                        ORDER BY 
                            `order_id` 
                        DESC");
// Fetch data from user table
$sql->execute();
$result = $sql->get_result();
?>
<h2 class="dash-content-heading head-2">Todays Orders</h2>
<table>
    <thead class="thead-2">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Customer Email</th>
            <th>City</th>
            <th>Service Name</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["order_id"] . "</td>
                        <td>" . $row["customer_name"] . "</td>
                        <td>" . $row["customer_email"] . "</td>
                        <td>" . $row["customer_city"] . "</td>
                        <td>" . $row["service_name"] . "</td>
                        <td>" . $row["order_status"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No users found</td></tr>";
        }
        $conn->close();
        echo '</tbody>
</table>';