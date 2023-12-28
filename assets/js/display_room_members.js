<!-- Display room members -->

    function updateRoomMembers(roomId) {
    var roomMembersContainer = $('#room_members');
    $.ajax({
    type: 'GET',
    url: 'controllers/roomMember_controller.php',
    data: { roomId: roomId },
    success: function(response) {
    roomMembersContainer.html(response);
    document.querySelector(".user-container").classList.add('hidden');
},
    error: function(error) {
    console.error('Ajax request failed:', error);
}
});
}

