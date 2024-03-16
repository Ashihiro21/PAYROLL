<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Clock with Form</title>
    <style>
        #clock {
            font-size: 36px;
            text-align: center;
            margin-top: 50px;
        }
        #date {
            font-size: 24px;
            text-align: center;
            margin-top: 10px;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        #running-time {
            display: none;
        }
        .btn {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .success-message {
        padding: 10px 20px;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
        margin-bottom: 20px;
    }
        .error-message {
        padding: 10px 20px;
        background-color: #f8d7da; /* Light red */
        color: #721c24; /* Dark red */
        border: 1px solid #f5c6cb; /* Lighter red */
        border-radius: 4px;
        margin-bottom: 20px;
    }



    </style>
</head>
<body>
    <div id="running-time">
        <script>
            // Function to update the clock every second
            function updateClock() {
                var now = new Date();
                var hours = now.getHours();
                var minutes = now.getMinutes();
                var seconds = now.getSeconds();
                var day = now.getDate();
                var month = now.getMonth() + 1; // getMonth() returns 0-11 for months, so we add 1
                var year = now.getFullYear();
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var dayOfWeek = days[now.getDay()];

                // Convert to 12-hour format
                var ampm = hours >= 12 ? 'PM' : 'AM';
                hours = hours % 12;
                hours = hours ? hours : 12; // the hour '0' should be '12'

                // Add leading zeros if necessary
                hours = (hours < 10) ? "0" + hours : hours;
                minutes = (minutes < 10) ? "0" + minutes : minutes;
                seconds = (seconds < 10) ? "0" + seconds : seconds;
                day = (day < 10) ? "0" + day : day;
                month = (month < 10) ? "0" + month : month;

                // Update the clock display
                document.getElementById('clock').textContent = hours + ":" + minutes + ":" + seconds + " " + ampm;
                document.getElementById('date').textContent = dayOfWeek + ", " + day + "/" + month + "/" + year;

                document.getElementById('time').value = hours + ":" + minutes;
            }

            // Call updateClock function every second
            setInterval(updateClock, 1000);
        </script>
    </div>

    <div id="clock">
        <?php echo date("h:i:s A"); ?> <!-- Initial clock display using PHP -->
    </div>
    <div id="date">
        <?php echo date("l, d/m/Y"); ?> <!-- Initial date display using PHP -->
    </div>

    <?php
session_start(); // Resume the session

if(isset($_SESSION['success_message'])) {
    echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']); // Remove the success message from session to prevent displaying it again on page refresh
}elseif(isset($_SESSION['error_message'])) {
    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Remove the success message from session to prevent displaying it again on page refresh
}
?>



    <form method="post" action="submit.php">
        <label for="Employee_No">Employee No:</label>
        <input type="text" id="Employee_No" name="Employee_No" required><br><br>
        <label for="log_type">Select Time Type:</label>
        <select id="log_type" name="log_type">
            <option value="time_in">Time In AM</option>
            <option value="time_out">Time Out AM</option>
            <option value="time_in2">Time In PM</option>
            <option value="time_out2">Time Out PM</option>
        </select><br><br>
        <label for="time">Time:</label>
        <input type="hidden" id="time" name="time">
        <input type="submit" value="Submit" onclick="populateHiddenFields()">
    </form>


    <script>
        function populateHiddenFields() {
            var selectedTimeType = document.getElementById("log_type").value;
            var currentTime = new Date().toLocaleTimeString();
            document.getElementById("time").value = currentTime;
        }

    </script>

<script>
    // Select the success message element
    const successMessage = document.querySelector('.success-message');

    // Function to remove the success message after 2 seconds
    const removeSuccessMessage = () => {
        setTimeout(() => {
            successMessage.remove();
        }, 3000); // 2000 milliseconds = 2 seconds
    };

    // Call the function to remove the success message
    removeSuccessMessage();
</script>
</body>
</html>
