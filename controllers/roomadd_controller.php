<?php
$db = mysqli_connect('localhost', 'root', '', 'chat');
include_once '../_classes/Room.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_room'])) {
    $roomName = filter_input(INPUT_POST, 'roomName', FILTER_SANITIZE_STRING);
    $members = isset($_POST['room_members']) ? $_POST['room_members'] : [];

    if (isset($_SESSION["user_id"])) {
        $creator = $_SESSION["user_id"];


        // Call the insertRoom method from the Room class
        $room = Room::insertRoom($roomName, $creator, $members, $db);
    } else {
        // Handle the case where the user is not logged in
        echo "User not logged in.";
    }
}
