document.getElementById('profileClick').addEventListener('click', function() {
    // Use AJAX to load content from profile_view.php
    $.ajax({
        url: 'views/profile_view.php',
        type: 'GET',
        success: function(data) {
            // Display the content in the modal
            $('#profileContent').html(data);
            $('#profileModal').show();
        },
        error: function() {
            alert('Error loading profile_view.php');
        }
    });
});