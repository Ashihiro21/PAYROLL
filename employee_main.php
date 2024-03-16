<?php

session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAYROLL ANDSYSTEM</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles.css">

      <style>

body{
    padding:0px;
    margin: 0px;
}
     .circle-button img {
    width: 50px;   
    height: 50px;  
    border-radius: 50%;
    object-fit: cover;
}
.circle-button{
    background-color: #0e2238;
    border: none;
}

.dropdown-toggle::after{
    color: #0e2238;
}


.tittle {
    margin-left: 1rem;
}
.responsive-image {
    max-width: 100%;
    height: auto;
    padding: 20px;
}


.update_profile_btn{
    border: transparent;
}





      </style>
</head>

<body>
    <div class="header" style="padding:1rem">
    
        <h1 class='tittle'>Payroll Management System
        
        
        <?php
                    include_once('db_config.php');

                    // Initialize or define the $page variable

                    // Use a parameterized query to prevent SQL injection
                    $sql = "SELECT * FROM employee WHERE email = :email";
                    $stmt = $conn->prepare($sql);

                    // Bind the parameter
                    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

                    // Execute the query
                    $stmt->execute();

                    // Get the result
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
              
                    // Your existing code...
                    if ($result) {

                    
                        echo "
                        <span class='users'>
                        <button class='circle-button dropdown-toggle' 
                            data-bs-toggle='dropdown' 
                            aria-expanded='false' 
                            aria-haspopup='true'
                            aria-controls='dropdown-menu' 
                            aria-label='Open user options'>
                            <img class='User_Image1'  src='{$result['images']}' alt='Profile picture of {$result['first_name']}  {$result['last_name']}'>
                        </button>
                                
                        <div class='text-logo' role='contentinfo' aria-label='User Information'> 
                            {$result['first_name']}  {$result['last_name']} 
                        </div>
                        <div aria-live='polite' aria-atomic='true' class='dropdown-menu mt-3 id='dropdown-menu' style='width: 300px;'> <!-- Adjust the width as needed -->
                        <img src='" . $result['images'] . "' alt='Picture of {$result['first_name']} {$result['last_name']}' class='responsive-image'>
                        <div class='text-logo1' role='contentinfo' aria-label='User Information'>
                            {$result['first_name']} {$result['last_name']}
                        </div>
                        <div class='footer mt-5'>
                            <button class='btn btn1 ms-2 text-white' style='border: none;' data-bs-toggle='modal' data-bs-target='#updateProfileModal'>
                                <i class='lni lni-pencil me-4'></i> Update Profile
                            </button>
                            <div class='sidebar-footer'>
                                <a href='logout1.php' class='sidebar-link'>
                                    <i class='lni lni-exit'></i><a>Logout</a>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                        ";
                       
                    } else {
                        echo "0 results";
                    }
            
                    $stmt->closeCursor();
                    ?>
                   

        </h1>
    
        
    </div>
    <div class="wrapper">

        <aside id="sidebar">
            <div class="d-flex">
                <div class="sidebar-logo">
                <button class="toggle-btn ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
                <i class="lni lni-grid-alt"></i>
            </button>
                    <?php
                    include_once('db_config.php');

                    // Initialize or define the $page variable
                    $page = isset($_GET['page']) ? $_GET['page'] : 'employee_dashboard.php';

                    // Use a parameterized query to prevent SQL injection
                    $sql = "SELECT * FROM employee WHERE email = :email";
                    $stmt = $conn->prepare($sql);

                    // Bind the parameter
                    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

                    // Execute the query
                    $stmt->execute();

                    // Get the result
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
              
                    // Your existing code...
                    
                    if ($result) {
                        // Output data
                        echo "<div class='user-info ms-2'>";
                        echo "<img src='" . $result['images'] . "' alt='User Image' class='user-image'>";
                        echo "<a class='text-center m-1' href='#'>";
                        echo $result['first_name'] . " " . $result['last_name'];
                        echo "</a>";
                        echo "</div>";
                    } else {
                        echo "0 results";
                    }
                    
                    // Continue with any remaining code...
                   
                    

                    // Close the statement and connection
                    $stmt->closeCursor(); // optional
                    $conn = null;
                    ?>
                </div>
            </div>
            <ul class="sidebar-nav">
                
                        <li class="sidebar-item">
                <a href="?page=my_dashboard.php" class="sidebar-link"<?php if ($page === 'my_dashboard.php') echo ' class="active"'; ?>>
                    <i class="lni lni-dashboard"></i> <!-- Replace "lni-checkmark-circle" with the desired LineIcons class -->
                    <span>Dashboard</span>
                </a>
            </li>
                        <li class="sidebar-item">
                <a href="?page=employee_leaves.php" class="sidebar-link"<?php if ($page === 'employee_leaves.php') echo ' class="active"'; ?>>
                    <i class="lni lni-hourglass"></i> <!-- Replace "lni-checkmark-circle" with the desired LineIcons class -->
                    <span>Leaves</span>
                </a>
            </li>
                
            
          
        </ul>
        
    </aside>
    <div class="main p-3">
        <div class="text-center">
            <?php
        include($page);
        ?>
            </div>
        </div>
    </div>
</body>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>

 $(document).ready(function () {
            // Fetch user data using AJAX
            $.ajax({
                url: "fetch_user_data1.php",
                type: "GET",
                success: function (userData) {
                    // Populate input fields with user data
                    $("#firstName").val(userData.first_name);
                    $("#lastName").val(userData.last_name);
                    $("#department").val(userData.department);
                    $("#position").val(userData.position);
                    $("#password").val(userData.password);

                    // Display the current profile image in the modal
                    var currentProfileImageModal = userData.image_url;
            if (currentProfileImageModal) {
                $("#currentProfileImageModal").attr("src", currentProfileImageModal);
                // Update the value of the hidden input field
                $("#currentProfileImageInput").val(currentProfileImageModal);

                // Automatically fill in the profileImage input with the current image
                $("#profileImage").val(currentProfileImageModal);
            }
        },
        error: function (error) {
            console.error(error);
        }
    });


            // Handle profile update form submission
            $("#updateProfileForm").submit(function (e) {
                e.preventDefault();

                // Check if a new profile image is selected
                var newProfileImage = $("#profileImage")[0].files[0];

                // Create FormData object to handle file uploads
                var formData = new FormData($(this)[0]);

                // Append the new profile image to FormData if selected
                if (newProfileImage) {
                    formData.append('profileImage', newProfileImage);
                }

                // Send AJAX request to update profile
                $.ajax({
                    url: "update_profile1.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // Handle the response from the server
                        console.log(response);
                        // Show alert
                        alert(response);
                        // Redirect back to nav.php
                        window.location.href = 'employee_main.php';
                    },
                    error: function (error) {
                        console.error(error);
                        // Show error alert
                        alert("Error updating profile. Please try again.");
                    }
                });
            });
        });

        $(document).ready(function () {
            const hamBurger = document.querySelector(".toggle-btn");
            const sidebar = document.querySelector("#sidebar");

            // Initially hide text
            const sidebarTexts = document.querySelectorAll(".sidebar-link span");
            sidebarTexts.forEach(text => {
                text.style.display = "none";
            });

            // Check if the sidebar is initially expanded or stored in localStorage
            const isSidebarExpanded = localStorage.getItem("sidebarExpanded") === "true";

            // Toggle visibility of sidebar text based on the initial state
            sidebarTexts.forEach(text => {
                if (isSidebarExpanded) {
                    text.style.display = "inline";
                } else {
                    text.style.display = "none";
                }
            });

            // Set the initial state or retrieve from localStorage
            sidebar.classList.toggle("expand", isSidebarExpanded);

            hamBurger.addEventListener("click", function () {
                sidebar.classList.toggle("expand");

                // Toggle visibility of sidebar text after the toggle button is clicked
                sidebarTexts.forEach(text => {
                    if (sidebar.classList.contains("expand")) {
                        text.style.display = "inline";
                    } else {
                        text.style.display = "none";
                    }
                });

                // Store the state in localStorage
                localStorage.setItem("sidebarExpanded", sidebar.classList.contains("expand"));
            });
        });


        $(document).ready(function () {
        // Toggle password visibility
        $("#togglePassword").click(function () {
            var passwordInput = $("#password");
            var passwordToggle = $("#togglePassword i");

            if (passwordInput.attr("type") === "password") {
                passwordInput.attr("type", "text");
                passwordToggle.removeClass("lni-eye");
                passwordToggle.addClass("lni-eye-off");
            } else {
                passwordInput.attr("type", "password");
                passwordToggle.removeClass("lni-eye-off");
                passwordToggle.addClass("lni-eye");
            }
        });
    });

    
</script>

<!-- Update Profile Modal -->
<div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateProfileModalLabel">Update Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- Profile Update Form -->
                <form id="updateProfileForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" id="position" name="position" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="lni lni-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="currentProfileImageModal" class="form-label">Current Profile Image</label>
                        <img id="currentProfileImageModal" src="" alt="Current Profile Image" class="img-fluid">
                        <input type="hidden" id="currentProfileImageInput" name="currentProfileImageInput">
                    </div>

                    <!-- New Profile Image Input -->
                    <div class="mb-3">
                        <label for="profileImage" class="form-label">New Profile Image</label>
                        <input type="file" class="form-control" id="profileImage" name="profileImage">
                    </div>

                    <!-- Add more form fields as needed -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>



</body>

</html>