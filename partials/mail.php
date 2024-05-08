<?php

$mail = mail("omtugave555@gmail.com", "This just a trial mail!!", "Hello,om i am gopal sadavarte from May I Help You", "From: gopalsadavarte555@gmail.com");

if ($mail) {
    echo "mail sent successfully";
} else {
    echo "mail cant send";
}