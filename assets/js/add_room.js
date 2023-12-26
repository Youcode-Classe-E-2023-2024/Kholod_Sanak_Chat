$(document).ready(function () {
    // Handler for the "Cancel" button click
    $("#cancelButton").click(function () {
        window.location.href = 'index.php?page=home';
    });

    //add room

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