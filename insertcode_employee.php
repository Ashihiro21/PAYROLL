<?php
// Include database connection file
include_once('db_config.php');

// Function to generate a random 6-character uppercase alphanumeric string
function generateRandomString($length = 6) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_chars = strtoupper(substr(str_shuffle($characters), 0, $length));
    return $random_chars;
}

// Function to generate a random 6-digit number
function generateRandomNumber() {
    return sprintf('%06d', mt_rand(0, 999999));
}

// Function to generate Employee_No
function generateEmployeeNo() {
    $random_chars = generateRandomString();
    $random_number = generateRandomNumber();
    return $random_chars . $random_number;
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $email = $_POST['email']; // Add email field in your HTML form
    $password = generateRandomNumber(); // Generate numeric password

    // Check if email already exists
    $check_email_sql = "SELECT COUNT(*) FROM employee WHERE email = :email";
    $check_email_stmt = $conn->prepare($check_email_sql);
    $check_email_stmt->bindParam(':email', $email);
    $check_email_stmt->execute();
    $email_count = $check_email_stmt->fetchColumn();

    if ($email_count > 0) {
        // Email already exists, handle accordingly (display an error message, redirect, etc.)
        echo "Error: Email already exists.";
        exit;
    }

    // Generate Employee_No
    $Employee_No = generateEmployeeNo();

    // Handle image upload
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["images"]["name"]);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["images"]["tmp_name"], $target_file)) {
        // Insert user data into the database
        $insert_sql = "INSERT INTO employee (Employee_No, first_name, last_name, department, position, images, email, password) VALUES (:Employee_No, :first_name, :last_name, :department, :position, :images, :email, :password)";

        // Prepare and bind the statement
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bindParam(':Employee_No', $Employee_No);
        $insert_stmt->bindParam(':first_name', $first_name);
        $insert_stmt->bindParam(':last_name', $last_name);
        $insert_stmt->bindParam(':department', $department);
        $insert_stmt->bindParam(':position', $position);
        $insert_stmt->bindParam(':images', $target_file);
        $insert_stmt->bindParam(':email', $email);
        $insert_stmt->bindParam(':password', $password);

        // Execute the query
        if ($insert_stmt->execute()) {
            // Registration successful, redirect to login page
            header('Location: nav.php?page=employee.php');
            exit;
        } else {
            // Registration failed
            echo "Error: " . $insert_stmt->errorInfo()[2];
        }

        // Close the insert statement
        $insert_stmt = null;
    } else {
        // Image upload failed
        echo "Sorry, there was an error uploading your file.";
    }

    // Close the check email statement
    $check_email_stmt = null;
}

// Close the database connection
$conn = null;
?>
 <script>
        $('.editImageBtn').on('click', function () {
                $('#editimagemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                // Assuming the first column contains the employee ID
                $('#update_image_id').val(data[0]);
            });
    </script>
    <script>
   $(function () {
    $(".show-alert__error").click(function () {
        FancyAlerts.show({ msg: "Uh oh something went wrong!", type: "error" });
    });
    $(".show-alert__success").click(function () {
        FancyAlerts.show({ msg: "succesfully registered !" });
    });
    $(".show-alert__info").click(function () {
        FancyAlerts.show({
            msg: "So long and thanks for all the shoes.",
            type: "info"
        });
    });
});

var FancyAlerts = (function () {
    var self = this;

    self.show = function (options) {
        if ($(".fancy-alert").length > -1) {
            FancyAlerts.hide();
        }
        var defaults = {
            type: "success",
            msg: "Success",
            timeout: 5000,
            icon: "fa fa-check",
            onClose: function () {}
        };

        if (options.type === "error" && !options.icon)
            options.icon = "fa fa-exclamation-triangle";
        if (options.type === "info" && !options.icon)
            options.icon = "fa fa-cog";

        var options = $.extend(defaults, options);

        var $alert = $(
            '<div class="fancy-alert ' +
                options.type +
                ' ">' +
                '<div class="">' +
                '<i class="fancy-alert--icon ' +
                options.icon +
                '"></i>' +
                '<div class="fancy-alert--content">' +
                '<div class="fancy-alert--words">' +
                options.msg +
                "</div>" +
                '<a class="fancy-alert--close" href="#"><i class="fa fa-times"></i></a>' +
                "</div>" +
                "</div>" +
                "</div>"
        );

        $("body").prepend($alert);
        setTimeout(function () {
            $alert.addClass("fancy-alert__active");
        }, 10);

        setTimeout(function () {
            $alert.addClass("fancy-alert__extended");
        }, 500);

        if (options.timeout) {
            self.hide(options.timeout);
        }
        $(".fancy-alert--close").on("click", function (e) {
            e.preventDefault();
            self.hide();
        });

        $alert.on("fancyAlertClosed", function () {
            options.onClose();
        });
    };

    self.hide = function (_delay) {
        var delay = _delay || 0;

        var $alert = $(".fancy-alert");
        setTimeout(function () {
            setTimeout(function () {
                $alert.removeClass("fancy-alert__extended");
            }, 10);

            setTimeout(function () {
                $alert.removeClass("fancy-alert__active");
            }, 500);
            setTimeout(function () {
                $alert.trigger("fancyAlertClosed");
                $alert.remove();
            }, 1000);
        }, delay);
    };

    return self;
})();

</script>


