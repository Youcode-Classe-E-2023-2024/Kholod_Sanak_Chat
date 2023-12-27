<?php
$db = mysqli_connect('localhost', 'root', '', 'chat');
if (file_exists('../_classes/Friend_request.php')) {
    include_once '../_classes/Friend_request.php';
    include_once '../_classes/Room.php';
    include_once '../_classes/User.php';

    session_start();
}

// Check if room_id is set in the request
if (isset($_GET['roomId'])) {
    $roomId = $_GET['roomId'];

    // Assuming you have a function to get messages for a specific room
    $messages = Room::getMessagesForRoom($roomId, $db);

    // Output the chat messages as an array
    $output = array();
    foreach ($messages as $message) {
        $output[] = array(
            'picture' => $message['picture'],
            'username' => $message['username'],
            'date' => $message['date'],
            'message' => $message['message'],
        );
    }

    // Encode the array as JSON and output
    echo json_encode($output);
} else {
    // Handle the case where room_id is not set in the request
    echo 'Invalid request';
}

