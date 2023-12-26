<?php
include_once '../_classes/User.php';
$db = mysqli_connect('localhost', 'root', '', 'chat');


?>

<div class="min-h-screen bg-gray-300 py-6 flex flex-col justify-center sm:py-12">
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        <div class="relative px-4 py-10 bg-gray-700 mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
            <div class="max-w-md mx-auto">
                <div class="flex items-center space-x-5">
                    <div class="block pl-2 font-semibold text-xl self-start text-white">
                        <h2 class="leading-relaxed">Add Room</h2>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <div class="py-8 text-base leading-6 space-y-4 text-gray-300  sm:text-lg sm:leading-7">
                           <!--form -->
                            <form method="post" action="index.php?page=roomadd">
                                    <div class="flex flex-col">
                                        <label class="leading-loose">Room Name</label>
                                        <input type="text" id="roomName" name="room_name" class=" bg-gray-600 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600" placeholder="room name">
                                    </div>

                                    <div class="flex flex-col">
                                        <label class="leading-loose">Room members</label>
                                        <select
                                            id="room_members"
                                            name="room_members[]"
                                            multiple
                                            class="bg-gray-600 text-gray-600 px-4 py-2 border focus:ring-gray-500
                                            focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md
                                            focus:outline-none ">

                                            <?php $users = User::getAll($db);
                                            foreach ($users as $user) {
                                                echo '<option value="' . $user['user_id'] . '">' . $user['username'] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="pt-4 flex items-center space-x-4">
                                    <div id="cancelButton" class="flex justify-center items-center w-full text-gray-300 px-4 py-3 rounded-md focus:outline-none">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg> Cancel
                                    </div>

                                    <button type="submit" id="addRoom" name="add_room" class="bg-blue-800 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">Add</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            // Handler for the "Cancel" button click
            $("#cancelButton").click(function () {
                window.location.href = 'index.php?page=home';
            });

            $("#addRoom").click(function () {
                console.log("clicked");
                $.ajax({
                    type: "POST",
                    url: "controllers/roomadd_controller.php",
                    data: {
                        add_room: 1,
                        room_members: $("#room_members").val(),
                        roomName: $("#roomName").val()
                    },
                    success: (data) =>{
                        console.log(data);
                    }
                })
            });
        });
    </script>

