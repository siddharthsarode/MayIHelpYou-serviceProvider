<?php
$sql = $conn->prepare("SELECT * FROM `user_order`,`order_details`,`order_to_order_details`,`services`,`user_payment`
                             WHERE `user_order`.`order_id`=`order_to_order_details`.`ord_id` 
                               AND `order_details`.`order_details_id`=`order_to_order_details`.`ord_details_id`
                               AND `services`.`service_id`=`order_details`.`order_service_id`
                               AND `user_order`.`order_id`=`user_payment`.`payment_order_id`
                               AND `payment_user_id`=?");
$sql->bind_param("s", $_SESSION['user_id']);
$sql->execute();
$result = $sql->get_result();
?>

<body>
    <div class="user-order-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="content-box">
            <div class="head">
                <h1 class="heading"><?php echo $row['service_name']; ?></h1>
            </div>
            <div class="order-details">
                <p><?php echo $row['description']; ?></p>
                <div class="content d-flex">
                    <div class="order-label">
                        <span>Customer Name:</span>
                        <span>Customer Email:</span>
                        <span>Contact No.:</span>
                        <span>Service Address:</span>
                        <span>Service Average Duration:</span>
                        <span>Paid Amount:</span>
                        <span>Transaction Id:</span>
                        <span>Payment Status:</span>
                        <span>Order Status:</span>
                        <span>Order Date:</span>
                        <span>Order Time:</span>
                    </div>
                    <div class="order-data">
                        <span><?php echo $row['customer_name']; ?></span>
                        <span><?php echo $row['customer_email']; ?></span>
                        <span><?php echo $row['contact_no']; ?></span>
                        <span><?php echo $row['service_address']; ?></span>
                        <span><?php echo $row['avg_duration']; ?></span>
                        <span><?php echo $row['price']; ?></span>
                        <span><?php echo $row['transaction_id']; ?></span>
                        <span><?php echo $row['payment_status']; ?></span>
                        <span><?php echo $row['order_status']; ?></span>
                        <span><?php echo substr($row['order_create_at'], 0, 10); ?></span>
                        <span><?php echo substr($row['order_create_at'], 10); ?></span>
                    </div>
                </div>
                <div class="data d-flex">
                    <?php if ($row['order_status'] == "pending") : ?>
                    <a class="cancel-btn" id="cancel-btn">Cancel</a>
                    <?php else : ?>
                    <a class="cancel-btn">Cancel</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</body>