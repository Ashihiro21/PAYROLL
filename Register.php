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

// Function to get default images path or URL
function getDefaultImages() {
    // Provide the path or URL of your default images
    return 'img/dp.jpg';
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $password = $_POST['password']; // For simplicity, password is not hashed here. You should hash it before storing it in the database.

    // Generate Employee_No
    $Employee_No = generateEmployeeNo();

    // Get default images path or URL
    $default_images = getDefaultImages();

    // Check if the email already exists
    $check_sql = "SELECT * FROM employee WHERE email = :email";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bindParam(':email', $email);
    $check_stmt->execute();
    $check_result = $check_stmt->fetch(PDO::FETCH_ASSOC);

    if ($check_result) {
        // Email already exists, display an error message or handle it as per your requirement
        echo '<p style="color: red;">Email already exists.</p>';
    } else {
        // Insert user data into the database
        $insert_sql = "INSERT INTO employee (Employee_No, first_name, last_name, email, department, position, password, images) VALUES (:Employee_No, :first_name, :last_name, :email, :department, :position, :password, :images)";
        
        // Prepare and bind the statement
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bindParam(':Employee_No', $Employee_No);
        $insert_stmt->bindParam(':first_name', $first_name);
        $insert_stmt->bindParam(':last_name', $last_name);
        $insert_stmt->bindParam(':email', $email);
        $insert_stmt->bindParam(':department', $department);
        $insert_stmt->bindParam(':position', $position);
        $insert_stmt->bindParam(':password', $password); // Remember to hash the password
        $insert_stmt->bindParam(':images', $default_images);

        // Execute the query
        if ($insert_stmt->execute()) {
            // Registration successful, redirect to login page
            header('Location: index.php');
            exit;
        } else {
            // Registration failed
            echo "Error: " . $conn->error;
        }

        // Close the insert statement
        $insert_stmt = null;
    }

    // Close the check statement
    $check_stmt = null;
}

// Close the database connection
$conn = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <title>Registration</title>
    <style>
        body{
            background-color:  #0e2238;
        }
        .centered-form{
            margin-top: 200px;
        }

        .centered-form .panel{
            background: rgba(255, 255, 255, 0.8);
            box-shadow: rgba(0, 0, 0, 0.3) 20px 20px 20px;
        }
        .btn{
            background-color: #0e2238;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Employee Registration</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First name *</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control inputdefault" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last name *</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control inputdefault" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="department">Department *</label>
                            <input type="text" class="form-control" id="department" name="department" required>
                        </div>
                        <div class="form-group">
                            <label for="position">Position *</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>


                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password" id="password" class="form-control inputdefault" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password *</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control inputdefault" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                        <div id="passwordError" style="color:red;"></div>
                        <input type="submit" name="submit" class="btn btn-dark btn-md btn-block" value="submit" id="submitbtn">
                        
                        <div id="register-link" class="text-right">
                                <a href="index.php" class="text-info text-dark">log in here</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript to compare password and confirm password fields
    $(document).ready(function(){
        $("#submitBtn").click(function(){
            var password = $("#password").val();
            var confirmPassword = $("#password_confirmation").val();
            if(password != confirmPassword){
                $("#passwordError").html("Passwords do not match!");
                return false;
            }
            return true;
        });
    });
</script>

</body>
</html>
