<?php

$db = mysqli_connect('localhost', 'root', '', 'chat');
if (file_exists('../_classes/Friend_request.php')) {
    include_once '../_classes/Friend_request.php';
    include_once '../_classes/Room.php';
    include_once '../_classes/User.php';

    session_start();
}


// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the required parameters are set
    if (isset($_POST['roomId']) && isset($_POST['messageContent'])) {
        // Get the data from the POST request
        $roomId = $_POST['roomId'];
        $messageContent = $_POST['messageContent'];
        $userId=$_SESSION['user_id'];


        $success = Room::addMessage($roomId, $userId, $messageContent, $db);

        // Send a response back to the client
        if ($success) {
            echo 'Message added successfully';
        } else {
            echo 'Failed to add message';
        }
    } else {
        // Parameters not set
        echo 'Missing parameters';
    }
} else {
    // Not a POST request
    echo 'Invalid request method';
}
