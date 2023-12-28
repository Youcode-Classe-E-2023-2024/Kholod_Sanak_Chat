<!-- Display users -->

    $(document).ready(function() {
    function getUsers() {
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
    }

    // Add a click event for the "Add Friend" button
    $(document).on('click', '.add-friend-btn', function() {
    var userId = $(this).data('user-id');
});
});

