<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "payroll_system";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get user input
    $email = $conn->real_escape_string($_POST['username']); // Assuming the email input field is used for both username and email
    $password = $conn->real_escape_string($_POST['password']);

    // Query the admin table for the user
    $query_admin = "SELECT * FROM admin WHERE username='$email' AND password='$password'";
    $result_admin = $conn->query($query_admin);

    // Query the employee table for the user
    $query_employee = "SELECT * FROM employee WHERE email='$email' AND password='$password'";
    $result_employee = $conn->query($query_employee);

    if ($result_admin && $result_admin->num_rows == 1) {
        // Valid admin user, start the session and redirect to the admin page
        $_SESSION['username'] = $email;
        header('Location: nav.php');
        exit();
    } elseif ($result_employee && $result_employee->num_rows == 1) {
        // Valid employee user, start the session and redirect to the employee page
        $_SESSION['email'] = $email;
        header('Location: employee_main.php');
        exit();
    } else {
        // Invalid credentials, show an error message
        $error_message = "Invalid email or password";
    }

    // Check for query errors
    if (!$result_admin) {
        echo "Error executing query: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0e2238;
            height: 100vh;
        }

        #login .container #login-row #login-column #login-box {
            margin-top: 120px;
            max-width: 600px;
            height: 380px;
            border: 1px solid #9C9C9C;
            background-color: #EAEAEA;
        }

        #login .container #login-row #login-column #login-box #login-form {
            padding: 20px;
        }

        .btn {
            background-color: #0e2238;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: 50px;
            margin-left: 25px;
        }

        .register {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-dark">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-dark">Username or email:</label><br>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-dark btn-md" value="Submit">
                                </div>
                                <div class="register">
                                    <h5>Don't have an account? <a href="register.php" class="text-info text-primary text-justify">Register here</a></h5>
                                </div>
                            </div>
                            <div class="form-group" id="error-message">
                            <?php if (isset($error_message)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error_message; ?>
                                </div>
                                <script>
                                    // JavaScript code to hide the error message after 2 seconds
                                    setTimeout(function() {
                                        document.getElementById('error-message').style.display = 'none';
                                    }, 2000);
                                </script>
                            <?php endif; ?>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>