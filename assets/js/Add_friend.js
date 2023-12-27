$(document).ready(function () {
    $('.add-friend-btn').on("click",function () {
        //console.log($(this));
        var userId = $(this).data('userId');
        console.log(userId);

        // Make an AJAX request to send a friend request
        $.ajax({
            type: 'POST',
            url: 'controllers/home_controller.php',
            data: { user_id: userId },
            success: (data) =>{
                console.log(data);

            },
            error: function (error) {
                alert('Failed to send invitation.');
            }
        });
    });
});