




<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">

<style>
  div.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;
}
.btn{
        border: 1px solid gray;
    }
</style>


<h1>Dashboard</h1>

<div class="container-fluid">
  <div class="row">



  
  
    <?php
include_once("connection.php");

// Query to get the count of employees
$employeeQuery = "SELECT COUNT(*) as employeeCount FROM employee";
$employeeResult = $conn->query($employeeQuery);

// Query to get the count of deductions
$deductionQuery = "SELECT COUNT(*) as deductionCount FROM deduction";
$deductionResult = $conn->query($deductionQuery);

$holidayQuery = "SELECT COUNT(*) as holidayCount FROM holiday";
$holidayResult = $conn->query($holidayQuery);

// Query to get the count of schedules
$scheduleQuery = "SELECT COUNT(*) as scheduleCount FROM schedules";
$scheduleResult = $conn->query($scheduleQuery);

$positionQuery = "SELECT COUNT(*) as positionCount FROM position";
$positionResult = $conn->query($positionQuery);

if ($employeeResult && $deductionResult && $holidayResult && $scheduleResult && $positionResult) {
    // Fetch the result for employees as an associative array
    $employeeRow = $employeeResult->fetch_assoc();
    // Fetch the result for deductions as an associative array
    $deductionRow = $deductionResult->fetch_assoc();

    $holidayRow = $holidayResult->fetch_assoc();
    // Fetch the result for schedules as an associative array
    $scheduleRow = $scheduleResult->fetch_assoc();
    
    $positionRow = $positionResult->fetch_assoc();

    $holidayCount = $holidayRow['holidayCount'];
    $scheduleCount = $scheduleRow['scheduleCount'];


    // Get the count values
    $employeeCount = $employeeRow['employeeCount'];
    $deductionCount = $deductionRow['deductionCount'];

    $positionCount = $positionRow['positionCount'];


    // Close the result sets
    $employeeResult->close();
    $deductionResult->close();
    $holidayResult->close();
    $scheduleResult->close();
    $positionResult->close();
} else {
    echo "Error executing query: " . $conn->error;
}

// Close the database connection
$conn->close();
?>

  <div class="container">
    <div class="row">

        <!-- Employee Card -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header"><b>Employee</b></div>
                <div class="card-body">
                    <h5 class="card-title">No. Of Employee</h5>
                    <p class="card-text"><?php echo "Number of Employees: " . $employeeCount; ?></p>
                    <a class="btn btn-primary shadow" href="nav.php?page=employee.php">Click This</a>
                </div>
            </div>
        </div>

        <!-- Deduction Card -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                <div class="card-header"><b>Deduction</b></div>
                <div class="card-body">
                    <h5 class="card-title">No. Of Deduction</h5>
                    <p class="card-text"><?php echo "Number of Deductions: " . $deductionCount; ?></p>
                    <a class="btn btn-primary shadow" href="nav.php?page=Deduction.php">Click This</a>
                </div>
            </div>
        </div>

        <!-- Holiday Card -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                <div class="card-header"><b>Holiday</b></div>
                <div class="card-body">
                    <h5 class="card-title">No. Of Holiday</h5>
                    <p class="card-text"><?php echo "Number of Holidays: " . $holidayCount; ?></p>
                    <a class="btn btn-primary shadow" href="nav.php?page=holiday.php">Click This</a>
                </div>
            </div>
        </div>

        <!-- Schedule Card -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
                <div class="card-header"><b>Schedule</b></div>
                <div class="card-body">
                    <h5 class="card-title">No. Of Schedule</h5>
                    <p class="card-text"><?php echo "Number of Schedules: " . $scheduleCount; ?></p>
                    <a class="btn btn-primary shadow" href="nav.php?page=schedule.php">Click This</a>
                </div>
            </div>
        </div>

        <!-- First Position Card -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header"><b>Position</b></div>
                <div class="card-body">
                    <h5 class="card-title">No. Of Positions</h5>
                    <p class="card-text"><?php echo "Number of Positions: " . $positionCount; ?></p>
                    <a class="btn btn-primary shadow" href="nav.php?page=position.php">Click This</a>
                </div>
            </div>
        </div>

        <!-- Second Position Card -->
        <div class="col-md-6 col-lg-4">
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header"><b>Position</b></div>
                <div class="card-body">
                    <h5 class="card-title">No. Of Positions</h5>
                    <p class="card-text"><?php echo "Number of Positions: " . $positionCount; ?></p>
                    <a class="btn btn-primary shadow" href="nav.php?page=position.php">Click This</a>
                </div>
            </div>
        </div>

  
        </div>

        </div>




