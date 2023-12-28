<?php
$db = mysqli_connect('localhost', 'root', '', 'chat');
if (file_exists('../_classes/Friend_request.php')) {
    include_once '../_classes/Friend_request.php';
    include_once '../_classes/Room.php';
    include_once '../_classes/User.php';

    session_start();
}
$users = User::getAll($db);

if (isset($_SESSION["user_id"])) {
    $creator = $_SESSION["user_id"];

    foreach ($users as $user) {
        if ($user['user_id'] == $creator) {
            continue;
        }
        echo '<div class="flex justify-between user-container">';
        echo '<img src="assets/img/' . $user['picture'] . '" alt="" class="w-12 rounded-l-2xl h-full object-cover">';
        echo '<p value="' . $user['user_id'] . '">' . $user['username'] . '</p>';
        echo '<button type="button" class="add-friend-btn" data-user-id="' . $user['user_id'] . '">Add Friend</button>';
        echo '</div>';
        echo '<br>';
    }
}
?>
