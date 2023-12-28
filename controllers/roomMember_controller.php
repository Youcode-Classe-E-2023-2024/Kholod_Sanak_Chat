<?php
$db = mysqli_connect('localhost', 'root', '', 'chat');
if (file_exists('../_classes/Room.php')) {
    include_once '../_classes/Room_member.php';
    include_once '../_classes/Room.php';
    include_once '../_classes/User.php';

    session_start();
}

$roomMembers = Room::getMembersForRoom($roomId, $db);

if ($roomMembers) {
    foreach ($roomMembers as $member) {
        echo '<div class="flex justify-between user-container">';
        echo '<img src="assets/img/' . $member['picture'] . '" alt="" class="w-12 rounded-l-2xl h-full object-cover">';
        echo '<p value="' . $member['user_id'] . '">' . $member['username'] . '</p>';
        echo '<button type="submit" class="add-friend-btn" data-user-id="' . $member['user_id'] . '">Add Friend</button>';
        echo '</div>';
        echo '<br>';
    }
} else {
    echo 'No room members found.';
}
