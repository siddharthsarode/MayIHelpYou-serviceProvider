<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT 
                            `customer_name`,
                            `customer_email`,
                            `service_address`,
                            `contact_no`,
                            `customer_city`,
                            `service_name`,
                            `price`,
                            `user_mobile_no`,
                            `user_city`,
                            `order_create_at`,
                            `create_update`,
                            `order_status`,
                            `transaction_id`,
                            `payment_status` 

                        FROM 
                            `order_details`,
                            `order_to_order_details`,
                            `services`,`user`,
                            `user_order`,
                            `user_payment` 

                        WHERE 
                            `services`.`service_id`=`order_details`.`order_service_id` 
                        AND 
                            `user_order`.`order_id`=`user_payment`.`payment_order_id` 
                        AND 
                            `user`.`user_id`=`user_payment`.`payment_user_id` 
                        AND 
                            `user_order`.`order_id`=`order_to_order_details`.`ord_id` 
                        AND 
                            `order_details`.`order_details_id`=`order_to_order_details`.`ord_details_id`
                        ORDER BY 
                            `order_id` 
                        DESC");
$sql->execute();
$res = $sql->get_result();
?>

<head>
    <style>
    tr,
    th,
    td {
        padding: 2rem;
    }
    </style>
</head>

<body>
    <div class="table-container" style="user-select: none;">
        <div class="table-content">
            <div class="header">
                <h1>User Order's</h1>
                <input type="text" name="searchBar" id="empSearchBar" placeholder="Search by Name...">
            </div>
            <div class="table-data" style="overflow: scroll; width: 101%;">
                <div class="table">
                    <table border="1px" cellspacing=0>
                        <tr>
                            <th rowspan="2">Customer Name</th>
                            <th rowspan="2">Customer Email</th>
                            <th rowspan="2">Address</th>
                            <th rowspan="2">Contact No.</th>
                            <th rowspan="2">City</th>
                            <th rowspan="2">Service Name</th>
                            <th rowspan="2">Advance Price</th>
                            <th rowspan="2">User Mobile</th>
                            <th rowspan="2">User city</th>
                            <th colspan="2">Date & Time</th>
                            <th rowspan="2">Transaction Id</th>
                            <th colspan="2">Status</th>
                            <th colspan="2">Operations</th>
                        </tr>
                        <tr>
                            <th>Give</th>
                            <th>Complete</th>
                            <th>Payment</th>
                            <th>Order</th>
                            <th>Accept</th>
                            <th>Reject</th>
                        </tr>
                        <?php
                        while ($row = $res->fetch_assoc()) {
                        ?> <tr>
                            <td class="searchKey"><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['customer_email']; ?></td>
                            <td><?php echo $row['service_address']; ?></td>
                            <td><?php echo $row['contact_no']; ?></td>
                            <td><?php echo $row['customer_city']; ?></td>
                            <td><?php echo $row['service_name']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['user_mobile_no']; ?></td>
                            <td><?php echo $row['user_city']; ?></td>
                            <td><?php echo $row['order_create_at']; ?></td>
                            <td><?php echo $row['create_update']; ?></td>
                            <td><?php echo $row['transaction_id']; ?></td>
                            <td class="payment-status"><?php echo $row['payment_status']; ?></td>
                            <td class="order-status"><?php echo $row['order_status']; ?></td>
                            <td style="display: none;"><?php echo $row['customer_email']; ?></td>
                            <td><button class="accept-order-btn">Accept</button></td>
                            <td style="display: none;"><?php echo $row['customer_email']; ?></td>
                            <td><button class="reject-order-btn">Reject</button></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pad-x form-container received-order-container" id="mail-container">
        <div class="form-box">
            <div class="form-heading d-flex">
                <h1 class="heading" style="text-align:center;">E-Mail Service</h1>
                <img src="../img/icons/close.png" id="close-img" style="position: relative;left:20%;top:-3rem;">
            </div>
            <form id="mail-form">
                <div class="form-element">
                    <label class="form-label" for="email">Email:To</label>
                    <input class="form-input" type="email" id="email" placeholder="E-mail" readonly required />
                </div>
                <div class="form-element">
                    <label class="form-label" for="subject">Subject</label>
                    <input class="form-input" type="text" id="subject" placeholder="Subject" required />
                </div>
                <div class="form-element">
                    <label class="form-label" for="message">Message</label>
                    <textarea class="text-area" id="message" cols="30" rows="10" style="resize:none;padding:.5rem;"
                        placeholder="Enter Message for Customer..."></textarea>
                </div>
                <div class="form-element">
                    <button class="form-input button submit-btn" id="send-btn">Send</button>
                </div>
            </form>
        </div>
    </div>
    <script src="./js/_acceptOrder.js"></script>
</body>