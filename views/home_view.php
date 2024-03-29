<?php

?>

<div class="font-sans antialiased h-screen flex">


    <!-- Chat content -->
    <div  id="chatContent" class="flex-1 flex flex-col bg-gray-700 overflow-hidden">
        <!-- Top bar -->
        <div class="border-b border-gray-600 flex px-6 py-2 items-center flex-none shadow-xl">
            <div class="flex flex-col">
                <h3 id="roomTitle" class="text-white mb-1 font-bold text-xl text-gray-100">
                    <span class="text-gray-400">#</span> Home</h3>
            </div>
        </div>
        <!-- Chat messages -->
        <div id="messagesContainer" class="px-6 py-4 flex-1 overflow-y-scroll">
            <!--Profil -->
            <!-- Modal-->
            <div id="profileModal" style="display: none;">
                <div id="profileContent"></div>
                <button onclick="closeModal()"></button>
            </div>

        </div>
        <!-- Chat input and submit button -->
        <div class="flex items-center px-6 py-2 border-t border-gray-600">
            <input type="text" id="messageInput" class="flex-1 px-4 py-2 mr-2 rounded-full border border-gray-500 focus:outline-none focus:border-blue-500" placeholder="Type your message...">
            <button id="sendMessageBtn" class="bg-blue-500 px-4 py-2 rounded-full text-white">Send</button>
        </div>
    </div>
    <!-- bar start -->
    <div class="bg-gray-800 text-purple-lighter flex-none w-64 pb-6 hidden md:block">
        <div
                class="text-white mb-2 mt-3 px-4 flex justify-between border-b border-gray-600 py-1 shadow-xl">
            <div class="flex-auto">
                <h1 class="font-semibold text-xl leading-tight mb-1 truncate">My Server</h1>
            </div>
            <div>
                <svg class="arrow-gKvcEx icon-2yIBmh opacity-50 cursor-pointer" width="24"
                     height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"
                          d="M16.59 8.59004L12 13.17L7.41 8.59004L6 10L12 16L18 10L16.59 8.59004Z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="mb-8">
            <div class="px-4 mb-2 text-white flex justify-between items-center">
                <div class="opacity-75 cursor-pointer">GENERAL</div>
                <div>
                    <svg class="fill-current h-5 w-5 opacity-50 cursor-pointer"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                                d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" />
                    </svg>
                </div>
            </div>
            <div class="bg-teal-dark cursor-pointer font-semibold py-1 px-4 text-gray-300">#
                general</div>
        </div>
        <div class="mb-8">
            <div class="px-4 mb-2 text-white flex justify-between items-center">
                <div class="opacity-75 cursor-pointer">Members</div>
                <div>
                    <svg class="fill-current h-5 w-5 opacity-50 cursor-pointer"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                                d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" />
                    </svg>
                </div>
            </div>
            <div
                    class="bg-teal-dark hover:bg-gray-800 cursor-pointer font-semibold py-1 px-4 text-gray-300">

                <div class="user-container">
                <?php
                $users = User::getAll($db);
                if (isset($_SESSION["user_id"])) {
                    $creator = $_SESSION["user_id"];

                    foreach ($users as $user) {
                        if ($user['user_id'] == $creator) {
                            continue;
                        }
                        echo '<div class="flex justify-between">';
                        echo '<img src="assets/img/' . $user['picture'] . '" alt="" class="w-12 rounded-l-2xl h-full object-cover">';
                        echo '<p value="' . $user['user_id'] . '">' . $user['username'] . '</p>';
                        echo '<button type="submit" class="add-friend-btn" data-user-id="' . $user['user_id'] . '">Add Friend</button>';
                        echo '</div>';
                        echo '<br>';
                    }
                }
                ?>

                </div>
                <div id="room_members"></div>
            </div>
        </div>
    </div>
    <!-- Bar end-->
    <!-- side bar start -->
    <div class="bg-gray-900 text-purple-lighter flex-none w-24 p-6 hidden md:block">
        <!-- Profil -->
        <div class="  cursor-pointer mb-4 border-b border-gray-600 pb-2"  id="profileClick">
            <div
                    class="bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-xl mb-1 overflow-hidden">
                <img src="https://cdn.discordapp.com/embed/avatars/0.png" alt="">
            </div>
        </div>
        <!-- Room -->
        <div class="cursor-pointer mb-4" id="roomContainer">
            <?php
            $rooms = Room::getAll();
            foreach ($rooms as $room) {
                echo '<div id="room" class="room-item bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden" data-room-id="' . $room['room_id'] . '">';
                echo '<p>' . $room['room_id'] . '</p>';
                echo '</div>';
            }
            ?>
        </div>



        <div id="addRoomTrigger" class="cursor-pointer mb-4" >
            <div class="bg-white opacity-25 h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden">
                <svg class="fill-current h-10 w-10 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" />
                </svg>
            </div>
        </div>

        <form method="post" action="index.php?page=logout">
            <button  type="submit" name="logout" class="cursor-pointer text-white text-lg">Logout</button>
        </form>
    </div>
    <!-- Sidebar End-->
</div>

<!-- display add room form -->
<div class="px-6 py-4 flex-1 overflow-y-scroll" id="chatContent">
</div>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Add  & display messages -->


<script>
   <!-- get room id-->
  let roomIdi = 0;
   $(document).ready(function() {
       function handleUpdateChatContent() {
           if ($.active === 0) {
               updateChatContent(roomIdi);
           } else {
               console.log('Previous AJAX request still active. Skipping update.');
           }
       }
       // Click event for the room items
       $('.room-item').off('click').on('click', function() {
           //console.log($(this));
           var roomId = $(this).data('room-id');
           roomIdi = roomId;
           updateChatContent(roomId);
           updateRoomMembers(roomId);

       });

       // Click event for the send message button
       $('#sendMessageBtn').on('click', function() {
           var roomId = getCurrentRoomId();
           roomIdi = roomId;
           var messageContent = $('#messageInput').val();

           if (messageContent.trim() !== '') {
               addMessage(roomId, messageContent);
               // Optionally, clear the input field after sending the message
               $('#messageInput').val('');
           }
       });
      // setInterval(handleUpdateChatContent, 1000);
   });


   // how to display
    function generateMessageHtml(message) {
        const imagePath = `assets/img/${message.picture}`;

        return `
        <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
            <img src="${imagePath}" class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
            <div class="flex-1 overflow-hidden">
                <div>
                    <span class="font-bold text-red-300 cursor-pointer hover:underline">${message.username}</span>
                    <span class="font-bold text-gray-400 text-xs">${message.date}</span>
                </div>
                <p class="text-white leading-normal">${message.message}</p>
            </div>
        </div>
    `;
    }
    ////////////////          get messages
    function updateChatContent(roomId) {
        // Set the room title
        $('#roomTitle').text('#' + roomId);

        // Assuming you have a PHP file to handle the server-side logic
        var ajaxUrl = 'controllers/displayChat_controller.php';

        // Make an Ajax request to get messages for the selected room
        $.ajax({
            type: 'GET',
            url: ajaxUrl,
            data: { roomId: roomId },
            success: function(response) {
                var messages = JSON.parse(response);
                console.log(messages);

                // Generate HTML for messages
                var messageHtml = '';
                for (var i = 0; i < messages.length; i++) {
                    messageHtml += generateMessageHtml(messages[i]);
                }

                // Clear existing messages and append the new messages
                $('#messagesContainer').html(messageHtml);

                // Show the chat content
                $('#chatContent').show();

                // Scroll to the bottom of the chat content
                var chatContent = document.getElementById('messagesContainer');
                chatContent.scrollTop = chatContent.scrollHeight;
            },
            error: function(error) {
                console.error('Ajax request failed:', error);
            }

        });
    }
    function getCurrentRoomId() {
        // Get the current room ID from the room title
        return $('#roomTitle').text().replace('#', '').trim();
    }

    function addMessage(roomId, messageContent) {
        // Assuming you have a PHP file to handle the server-side logic
        var ajaxUrl = 'controllers/addChat_controller.php';

        // Make an Ajax request to add the message
        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: { roomId: roomId, messageContent: messageContent },
            success: function(response) {
                console.log(response);
                updateChatContent(roomId);
            },
            error: function(error) {
                console.error('Ajax request failed:', error);
            }
        });
    }

</script>

<script src="<?= PATH ?>assets/js/add_room.js"></script>
<script src="<?= PATH ?>assets/js/Add_friend.js"></script>
<script src="<?= PATH ?>assets/js/display_addroom.js"></script>
<script src="<?= PATH ?>assets/js/display_room_members.js"></script>
<script src="<?= PATH ?>assets/js/display_users.js"></script>
<script src="<?= PATH ?>assets/js/invit.js"></script>
<script src="<?= PATH ?>assets/js/profile.js"></script>







