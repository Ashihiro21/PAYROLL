function submitForm(buttonId) {
    var button = document.getElementById(buttonId);
    button.disabled = true;
    // Your AJAX call to submit data to the server
    // Here, I'm simulating the AJAX call using setTimeout
    setTimeout(function() {
        // Assuming you're using jQuery for AJAX
        $.ajax({
            url: 'parctice_insert_into_database.php',
            type: 'POST',
            data: { button: buttonId },
            success: function(response) {
                console.log(response); // You can handle the response accordingly
            },
            error: function(xhr, status, error) {
                console.error(error); // Handle error if any
            }
        });
    }, 1000); // Adjust this time according to your requirements
}
