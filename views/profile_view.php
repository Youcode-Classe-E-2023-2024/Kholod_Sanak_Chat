<?php
$db = mysqli_connect('localhost', 'root', '', 'chat');
if (file_exists('../_classes/Friend_request.php')) {
    include_once '../_classes/Friend_request.php';
    include_once '../_classes/Room.php';
    include_once '../_classes/User.php';

    session_start();
}
//$request = new Friend_request();
?>
<div class=" profile min-h-screen flex flex-col max-w-md mx-auto bg-gray-400 opacity-100 font-poppins px-4 bg-no-repeat bg-cover bg-center">
    <div class="flex justify-between px-1 pt-4 items-center">
        <!-- Cancel button -->
        <div id="cancelButton" >
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <div>
            <p class="font-semibold">My Profile</p>
        </div>
        <div>
            <!-- options profile -->

            <div id="menuButton" class="menu-button">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill="none" d="M0 0h24v24H0z"/>
                    <path d="M12 3c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 14c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-7c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                </svg>
            </div>

            <div id="menu" class="menu">
                <ul>
                    <li id="deleteAccountButton"><a href="#">Delete Account</a></li>
                    <li id="logoutButton"><a href="#">Logout</a></li>
                    <li id="viewFriendListButton"><a href="#">View Friend List</a></li>
                </ul>
            </div>
            <!--Delete -->
<!--            <button>-->
<!--            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" id="delete" fill="currentColor" aria-hidden="true" class="h-4 w-4">-->
<!--                <path d="M24.2,12.193,23.8,24.3a3.988,3.988,0,0,1-4,3.857H12.2a3.988,3.988,0,0,1-4-3.853L7.8,12.193a1,1,0,0,1,2-.066l.4,12.11a2,2,0,0,0,2,1.923h7.6a2,2,0,0,0,2-1.927l.4-12.106a1,1,0,0,1,2,.066Zm1.323-4.029a1,1,0,0,1-1,1H7.478a1,1,0,0,1,0-2h3.1a1.276,1.276,0,0,0,1.273-1.148,2.991,2.991,0,0,1,2.984-2.694h2.33a2.991,2.991,0,0,1,2.984,2.694,1.276,1.276,0,0,0,1.273,1.148h3.1A1,1,0,0,1,25.522,8.164Zm-11.936-1h4.828a3.3,3.3,0,0,1-.255-.944,1,1,0,0,0-.994-.9h-2.33a1,1,0,0,0-.994.9A3.3,3.3,0,0,1,13.586,7.164Zm1.007,15.151V13.8a1,1,0,0,0-2,0v8.519a1,1,0,0,0,2,0Zm4.814,0V13.8a1,1,0,0,0-2,0v8.519a1,1,0,0,0,2,0Z"></path></svg>-->
<!--            </button>-->
        </div>
    </div>
    <div class="flex items-center px-4 pt-12 justify-between">
        <!-- profile picture -->
        <div >
            <?php
            // Assuming you have a User class with a method to get user data
            $user = User::getById($_SESSION["user_id"]);

            // Check if user data is retrieved successfully
            if ($user) {
                echo '<img src="assets/img/' . $user['picture'] . '" alt="" class="w-24 h-24 bg-blue-600 flex items-center rounded-full">';
            } else {
                echo 'Error fetching user data.';
            }
            ?>

        </div>
        <div class="w-9/12 flex items-center">
            <div class="w-10/12 flex flex-col leading-none pl-4">
                <p class="text-2xl font-bold">username</p>
                <!--<p class="text-sm pt-1 font-light text-gray-700">Network Engineer</p>-->
            </div>
            <!-- Modify -->
            <div class="w-2/12">
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-700" fill="currentColor" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M9.243 19H21v2H3v-4.243l9.9-9.9 4.242 4.244L9.242 19zm5.07-13.556l2.122-2.122a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414l-2.122 2.121-4.242-4.242z"/></svg>

                </button>
            </div>
        </div>
    </div>
    <!-- My rooms-->
    <div class="pt-12 px-4 w-full flex flex-col">
        <p class="font-semibold text-gray-600">My Rooms</p>
        <div class="flex flex-wrap w-full mt-2 space-x-2 space-y-2">
            <!-- Room display -->
            <?php
            $id = $_SESSION['user_id'];
            $rooms = Room::getRoomCreated($id);

            foreach ($rooms as $room) {
                echo '<button class="bg-gray-800 w-20 rounded-full px-4 py-2 font-light text-white flex">' .$room['room_name'] . '</button>';
            }
            ?>

        </div>
    </div>
    <div class="pt-12 px-4 w-full flex flex-col">
        <p class="font-semibold text-gray-600">Invitations</p>
        <div class="flex flex-col w-full pt-2 space-y-2">
            <?php
            $request = new Friend_request();
            $myId = $_SESSION['user_id'];
            $invites = $request->getInvitation($myId);

            foreach ($invites as $invite) {
                echo '<div class="flex w-full h-12">
            <div class="w-6/12 h-full flex items-start">
                <div><p class="my-auto text-lg font-semibold">' . $invite['username'] . '</p></div>
            </div>
            <div class="w-4/12 h-full flex justify-between space-x-2 items-end">
                <form action="index.php?page=profile" method="post">
                    <input type="hidden" name="myid" value="' . $_SESSION['user_id'] . '"> 
                    <input type="hidden" name="friendid" value="' . $invite['user_id'] . '">
                    <button type="submit" name="accept" class="flex bg-green-600 rounded-md my-auto px-5 py-1 float-right text-white font-medium">Accept</button>
                </form>
                <form action="index.php?page=profile" method="post">
                 <input type="hidden" name="myid" value="' . $_SESSION['user_id'] . '"> 
                 <input type="hidden" name="friendid" value="' . $invite['user_id'] . '">
                 <button type="submit" name="decline" class="flex bg-red-600 rounded-md my-auto px-5 py-1 float-right text-white font-medium">Refuse</button>
                </form>
            </div>
        </div>';
            }
            ?>


        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Handler for the "Cancel" button click
        $("#cancelButton").click(function () {
            $(".profile").hide();
        });
    });
</script>

<!-- option profile -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('menuButton');
        const menu = document.getElementById('menu');
        console.log(menuButton)

        menuButton.addEventListener('click', function() {
            //console.log("clicked");
            menu.classList.toggle('visible');
        });

        // Add event listeners for each menu item
        const deleteAccountButton = document.getElementById('deleteAccountButton');
        const logoutButton = document.getElementById('logoutButton');
        const viewFriendListButton = document.getElementById('viewFriendListButton');

        deleteAccountButton.addEventListener('click', function() {
            deleteAccount();
        });

        logoutButton.addEventListener('click', function() {
            logout();
        });

        viewFriendListButton.addEventListener('click', function() {
            viewFriendList();
        });
    });

    function deleteAccount() {
        // Implement your logic for deleting the account
        alert('Deleting Account...');
        // Add your code here to handle the deletion of the account
    }

    function logout() {
        // Implement your logic for logging out
        alert('Logging Out...');
        // Add your code here to handle the logout
    }

    function viewFriendList() {
        // Implement your logic for viewing the friend list
        alert('Viewing Friend List...');
        // Add your code here to handle viewing the friend list
    }

</script>




