<!-- Add this where you want to display the users -->
<div id="users-container"></div>

<!-- Add this script in your HTML or a separate JavaScript file -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Use AJAX to load users dynamically
        $.ajax({
            url: 'controllers/allUsers_controller.php',
            type: 'GET',
            success: function(response) {
                $('#users-container').html(response);
            },
            error: function() {
                console.log('Error loading users.');
            }
        });

        // Add a click event for the "Add Friend" button
        $(document).on('click', '.add-friend-btn', function() {
            var userId = $(this).data('user-id');
            // Perform AJAX request to add friend or any other action
            // Example: $.post('add_friend.php', { userId: userId }, function(response) { console.log(response); });
        });
    });
</script>


