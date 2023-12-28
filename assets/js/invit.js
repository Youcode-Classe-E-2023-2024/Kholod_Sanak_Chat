<!-- Send invitation -->

    $(document).ready(function() {
    $('.add-friend-btn').on("click", function() {
        var userId = $(this).data('user-id');

        $.ajax({
            type: 'POST',
            url: 'controllers/friendRequest_controller.php',
            data: { user_id: userId },
            success: function(data) {
                console.log(data);
            },
            error: function() {
                alert('Failed to send invitation.');
            }
        });
    });
});

