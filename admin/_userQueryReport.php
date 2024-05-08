<?php
require "../partials/_dbConnect.php";
$sql = $conn->prepare("SELECT * FROM `user`,`contact`
                              WHERE `user`.`user_id`=`contact`.`con_user_id`");
$sql->execute();
$result = $sql->get_result();
?>

<head>
    <style>
    th,
    td {
        padding: 1.5rem 1rem 1.5rem 1rem;
    }
    </style>
</head>

<body>
    <div class="table-container">
        <div class="table-content">
            <div class="header">
                <h1>User's Queries</h1>
                <input type="text" name="searchBar" id="userSearchBar" placeholder="Search by Employee Name...">
            </div>
            <div class="table-data">
                <div class="table" style="overflow:scroll;">
                    <table border="1px" cellspacing=0>
                        <tr>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Mobile No.</th>
                            <th>City</th>
                            <th>Message</th>
                            <th>Message Date</th>
                            <th>Status</th>
                            <th>Operation</th>
                        </tr>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="searchUserName"><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['user_mobile_no']; ?></td>
                            <td><?php echo $row['user_city']; ?></td>
                            <td><?php echo $row['message']; ?></td>
                            <td><?php echo $row['con_create_at']; ?></td>
                            <td class="contactStatus"><?php echo $row['con_status']; ?></td>
                            <td><button class="accept-order-btn reply reply-btn">Reply</button></td>
                        </tr>
                        <?php endwhile; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pad-x form-container received-order-container" id="mail-container">
        <div class="form-box">
            <div class="form-heading">
                <h1 class="heading" style="text-align:center;">E-Mail Service</h1>
                <img src="../img/icons/close.png" id="close-img" class="close-img"
                    style="position:relative;top:-2rem;left:17%;">
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
    <script src="./js/_userQueries.js"></script>
</body>