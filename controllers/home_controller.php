<?php

$db = mysqli_connect('localhost', 'root', '', 'chat');

if (file_exists('../_classes/Friend_request.php')) {
    include_once '../_classes/Friend_request.php';
    session_start();
}

if (isset($_POST['user_id'])) {
    $senderId = $_SESSION['user_id'];
    $receiverId = $_POST['user_id'];


//     Attempt to send a friend request
    $result = Friend_request::sendRequest($senderId, $receiverId);

//    if ($result) {
//        echo 'Friend request sent successfully';
//    } else {
//        echo 'Failed to send friend request';
//    }
}

