<?php

// Include necessary files and classes
// Include the Room class and any other required files

// Check if room_id is set in the request
if (isset($_GET['room_id'])) {
    $roomId = $_GET['room_id'];

    // Assuming you have a function to get messages for a specific room
    $messages = getMessagesForRoom($roomId);

    // Output the chat messages
    foreach ($messages as $message) {
        echo '<div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">';
        echo '<img src="' . $message['user_avatar'] . '" class="cursor-pointer w-10 h-10 rounded-3xl mr-3">';
        echo '<div class="flex-1 overflow-hidden">';
        echo '<div>';
        echo '<span class="font-bold text-red-300 cursor-pointer hover:underline">' . $message['username'] . '</span>';
        echo '<span class="font-bold text-gray-400 text-xs">' . $message['timestamp'] . '</span>';
        echo '</div>';
        echo '<p class="text-white leading-normal">' . $message['message'] . '</p>';
        echo '</div>';
        echo '</div>';
    }
} else {
    // Handle the case where room_id is not set in the request
    echo 'Invalid request';
}

