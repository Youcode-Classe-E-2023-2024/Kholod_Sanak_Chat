<?php

$db = mysqli_connect('localhost', 'root', '', 'chat');
if (file_exists('../_classes/Friend_request.php')) {
    include_once '../_classes/Friend_request.php';
    include_once '../_classes/Room.php';
    include_once '../_classes/User.php';

    session_start();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = $_POST['room'];
    $memberId = $_POST['member'];

    // Call the banMember function to ban the member
    Room::banMember($roomId, $memberId);

    echo 'Member banned successfully'; // You can customize the response message
} else {

    echo 'Invalid request method';
}
