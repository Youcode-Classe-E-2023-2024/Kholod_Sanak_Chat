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

    // Assuming you have a function to get room members
    $roomMembers = Room::getMembersForRoom($roomId,$db);


    // Output the room members HTML
    if ($roomMembers) {
        foreach ($roomMembers as $member) {
            echo '<div class="flex justify-between user-container">';
            echo '<img src="assets/img/' . $member['picture'] . '" alt="" class="w-12 rounded-l-2xl h-full object-cover">';
            echo '<p value="' . $member['user_id'] . '">' . $member['username'] . '</p>';
            echo '<button type="submit" class="add-friend-btn" data-user-id="' . $member['user_id'] . '"> Kickout</button>';
            echo '</div>';
            echo '<br>';
        }
    } else {
        echo 'No room members found.';
    }
} else {
    echo 'Invalid request';
}
?>
