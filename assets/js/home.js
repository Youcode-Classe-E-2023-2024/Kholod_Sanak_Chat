$(document).ready(function() {
    $('.room-item').on('click', function() {
        var roomId = $(this).data('room-id');

        // Check if the clicked room is the "Home" room
        if (roomId === 'Home') {
            // Redirect to the homepage or the desired location
            //window.location.href = '<?= PATH ?>index.php?page=home';
            getUsers();
        } else {
            updateChatContent(roomId);
        }
    });
});