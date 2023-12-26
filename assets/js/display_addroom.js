// Wait for the document to be ready
$(document).ready(function () {
    $("#addRoomTrigger").on("click", function () {
        $.ajax({
            url: 'views/roomadd_view.php',
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