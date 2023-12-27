<?php

$db = mysqli_connect('localhost', 'root', '', 'chat');

if (file_exists('../_classes/Friend_request.php')) {
    include_once '../_classes/Friend_request.php';
    session_start();
}

if (isset($_POST['user_id'])) {
    $senderId = $_SESSION['user_id'];
    $receiverId = $_POST['user_id'];
    Friend_request::sendRequest($senderId, $receiverId);


}

