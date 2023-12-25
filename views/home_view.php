

<div class="font-sans antialiased h-screen flex">


    <!-- Chat content -->
    <div class="flex-1 flex flex-col bg-gray-700 overflow-hidden">
        <!-- Top bar -->
        <div class="border-b border-gray-600 flex px-6 py-2 items-center flex-none shadow-xl">
            <div class="flex flex-col">
                <h3 class="text-white mb-1 font-bold text-xl text-gray-100">
                    <span class="text-gray-400">#</span> general</h3>
            </div>
        </div>
        <!-- Chat messages -->
        <div class="px-6 py-4 flex-1 overflow-y-scroll ">
            <!-- A message -->
            <div class="border-b border-gray-600 py-3 flex items-start mb-4 text-sm">
                <img src="https://cdn.discordapp.com/embed/avatars/0.png" class="cursor-pointer w-10 h-10 rounded-3xl mr-3">
                <div class="flex-1 overflow-hidden">
                    <div>
                        <span class="font-bold text-red-300 cursor-pointer hover:underline">User</span>
                        <span class="font-bold text-gray-400 text-xs">09:23</span>
                    </div>
                    <p class="text-white leading-normal">my message!</p>
                </div>
            </div>
            <!-- A message -->

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
                <div class="opacity-75 cursor-pointer">VOICE</div>
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
                ? General</div>
        </div>
    </div>
    <!-- Bar end-->
    <!-- side bar start -->
    <div class="bg-gray-900 text-purple-lighter flex-none w-24 p-6 hidden md:block">
        <div class="cursor-pointer mb-4 border-b border-gray-600 pb-2">
            <div
                    class="bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden">
                <img src="https://cdn.discordapp.com/embed/avatars/0.png" alt="">
            </div>
        </div>
        <div class="cursor-pointer mb-4">
            <div
                    class="bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-xl mb-1 overflow-hidden">
                <img src="https://cdn.discordapp.com/embed/avatars/0.png" alt="">
            </div>
        </div>
        <div class="cursor-pointer mb-4">
            <div
                    class="bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden">
                <img src="https://cdn.discordapp.com/embed/avatars/1.png" alt="">
            </div>
        </div>
        <div class="cursor-pointer mb-4">
            <div
                    class="bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden">
                <img src="https://cdn.discordapp.com/embed/avatars/2.png" alt="">
            </div>
        </div>
        <div class="cursor-pointer mb-4">
            <div
                    class="bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden">
                <img src="https://cdn.discordapp.com/embed/avatars/3.png" alt="">
            </div>
        </div>
        <div class="cursor-pointer mb-4">
            <div
                    class="bg-white h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden">
                <img src="https://cdn.discordapp.com/embed/avatars/4.png" alt="">
            </div>
        </div>
        <div id="addRoomTrigger" class="cursor-pointer" >
            <div class="bg-white opacity-25 h-12 w-12 flex items-center justify-center text-black text-2xl font-semibold rounded-3xl mb-1 overflow-hidden">
                <svg class="fill-current h-10 w-10 block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16 10c0 .553-.048 1-.601 1H11v4.399c0 .552-.447.601-1 .601-.553 0-1-.049-1-.601V11H4.601C4.049 11 4 10.553 4 10c0-.553.049-1 .601-1H9V4.601C9 4.048 9.447 4 10 4c.553 0 1 .048 1 .601V9h4.399c.553 0 .601.447.601 1z" />
                </svg>
            </div>
        </div>

    </div>
    <!-- Sidebar End-->
</div>

<div id="contentContainer"></div>

<div class="px-6 py-4 flex-1 overflow-y-scroll" id="chatContent">
    <!-- Existing chat messages will be loaded here -->
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    // Wait for the document to be ready
    $(document).ready(function () {
        $("#addRoomTrigger").on("click", function () {
            $.ajax({
                url: 'views/add_room_view.php',
                type: 'GET',
                success: function (data) {
                    $('.flex-1 .overflow-y-scroll').html(data);
                },
                error: function () {
                    alert('Failed to load content.');
                }
            });
        });
    });
</script>


