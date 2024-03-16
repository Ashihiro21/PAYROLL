
<?php
// Function to populate position dropdown from the database
function populatePositionDropdown() {
    // Replace these database connection details with your own
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

    // SQL query to get positions from the database (replace 'your_table_name' with the actual table name)
    $sql = "SELECT * FROM position";
    $result = $conn->query($sql);

    $options = "";

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $position = $row["position"];
            $options .= "<option value='$position'>$position</option>";
        }
    } else {
        $options .= "<option value=''>No positions found</option>";
    }

    $conn->close();

    return $options;
}


function populatetime_inDropdown() {
    // Replace these database connection details with your own
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

    // SQL query to get scheduless from the database (replace 'your_table_name' with the actual table name)
    $sql = "SELECT * FROM schedules";
    $result = $conn->query($sql);

    $options = "";

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $schedules = $row["schedules"];
            $options .= "<option value='$schedules'>$schedules</option>";
        }
    } else {
        $options .= "<option value=''>No scheduless found</option>";
    }

    $conn->close();

    return $options;
}
?>
?>
    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-wjRbq9zQ9lq3IXlTDCqonuG6ECB6yoa1vD8JdC3v4qfmhojWTStUpdoJhu1Il5Lq" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    .card .deletebtn,
.jumbotron .deletebtn {
    border-color: transparent; /* Set border-color to transparent or the color you desire */
}

.hide-id {
        display: none;
    }

    .btn{
        border: 1px solid gray;
    }
    
    @import "compass";

body {}

.fancy-alert {
    font-family: sans-serif;
    color: white;
    width: 78px;
    z-index: 1020;
    top: 0px;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    position: fixed;
    overflow: hidden;
    box-shadow: 0 4px rgba(0, 0, 0, 0.3);
    opacity: 0;
    height: 78px;
    background-color: gray;
    @include scale(0);
    transition: opacity 0.3s, top 0.5s, width 0.5s;

    &.fancy-alert__active {
        opacity: 1;
        top: 20px;
        @include scale(1);
    }

    &.fancy-alert__extended {
        width: 800px;
        transition: width 0.5s ease-out;

        .fancy-alert--content {
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .fancy-alert--words {
            top: 18px;
            opacity: 1;
            transition: top 0.5s ease-out, opacity 0.5s ease-out;
        }
    }

    &.error {
        background-color: #d64646;
    }

    &.success {
        background-color: #3cb971;
    }

    &.info {
        background-color: #e8c22c;
    }

    a {
        color: white;
        text-decoration: underline;
    }

    .fancy-alert--content {
        padding: 10px;
        opacity: 0;
    }

    .fancy-alert--words {
        font-size: 18px;
        font-weight: bold;
        padding: 0 18px 0 90px;
        max-width: 80%;
        position: relative;
        top: -50px;
        opacity: 0;
    }

    .fancy-alert--icon {
        padding: 26px;
        float: left;
        font-size: 26px;
        background-color: rgba(3, 3, 3, 0.15);
    }

    .fancy-alert--close {
        position: absolute;
        text-decoration: none;
        right: 10px;
        top: 10px;
        font-size: 15px;
        padding: 6px 9px;
        background: rgba(0, 0, 0, 0.12);
    }
}

.container {
    text-align: center;
    margin: 200px 0;
}

.show-alert {
    border: 0;
    background: #f2f2f2;
    padding: 15px 70px;
    font-weight: bold;
    border-radius: 5px;
    border-bottom: 3px solid #c8c8c8;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.23),
        inset 0 -53px 20px -30px rgba(59, 65, 74, 0.06);
    margin: 0 10px;
    font-size: 16px;
    cursor: pointer;
    color: #808080;
    text-shadow: 0 1px #fff;
    outline: 0;
    position: relative;

    &:active {
        border: 0;
        box-shadow: none;
        top: 2px;
    }
}

.show-alert__info {
    color: #e8c22c;
}

.show-alert__success {
    color: #3cb971;
}

.show-alert__error {
    color: #d64646;
}



</style>
<body>

    <!-- Modal -->
    <div class="modal fade" id="studentaddmodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form method="post" action="insertcode_employee.php" enctype="multipart/form-data">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Employee ID </label>
                            <input type="hidden" name="Employee_No" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label> Profile Image </label>
                            <input type="file" name="images" class="form-control">
                     </div>
                        <div class="form-group">
                            <label> First Name </label>
                            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
                        </div>

                        <div class="form-group">
                            <label> Department </label>
                            <input type="text" name="department" class="form-control" placeholder="Enter Department">
                        </div>

                        <div class="form-group">
                            <label> Position </label>
                            <select name="position" class="form-control">
                            <?php echo populatePositionDropdown(); ?>
                        </select>
                        </div>

                        

                        <div class="form-group">
                            <label> email </label>
                            <input type="text" name="email" class="form-control" placeholder="Enter email">
                        </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="show-alert show-alert__success btn btn-primary">Save Data</button>


                    </div>
                    
                </form>

            </div>
        </div>
    </div>

    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
  <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="updatecode_employee.php" method="POST">

                    <div class="modal-body">
                        <input type="hidden" name="update_id" id="update_id">
                        <input type="hidden" name="Employee_No" id="Employee_No">

                        <div class="form-group">
                            <label> First Name </label>
                            <input type="text" name="first_name" id="first_name" class="form-control"
                                placeholder="Enter First Name">
                        </div>

                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="Enter Last Name">
                        </div>

                        <div class="form-group">
                            <label> department </label>
                            <input type="text" name="department" id="department" class="form-control"
                                placeholder="Enter department">
                        </div>

                        <div class="form-group">
                            <label> position </label>
                            <select name="position" class="form-control">
                            <?php echo populatePositionDropdown(); ?>
                        </select>
                        </div>

                        <div class="form-group">
                            <label> email </label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Enter email">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- EDIT IMAGE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editimagemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Employee Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="update_image.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Add form fields for editing the image -->
                        <input type="hidden" name="update_image_id" id="update_image_id">
                        <div class="form-group">
                            <label> New Profile Image </label>
                            <input type="file" name="new_image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_image" class="btn btn-primary">Update Image</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode_employee.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>




    <!-- VIEW POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> View Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">

                        <input type="text" name="view_id" id="view_id">

                        <!-- <p id="first_name"> </p> -->
                        <h4 id="first_name"> <?php echo ''; ?> </h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> CLOSE </button>
                        <!-- <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button> -->
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="container-fluid" style="float: center;">
    <div class="jumbotron bg-light shadow border border-secondary">
            <div class="card bg-light" style="border-color: transparent;">
            
                <h2> Employee List </h2>
            </div>
            <div class="card bg-light" style="border-color: transparent;">
                <div class="card-body bg-light" style="border-color: transparent;">
                    <button type="button" class="btn btn-primary float-left" data-toggle="modal" data-target="#studentaddmodal1">
                        ADD DATA
                    </button>
                </div>
            </div>

            <div class="card bg-light" style="border-color: transparent;">
                <div class="card-body" style="border-color: transparent;">

                    <?php
                $connection = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($connection, 'payroll_system');

                $query = "SELECT * FROM `employee`";
                $query_run = mysqli_query($connection, $query);
            ?>  
                   
                    <table id="datatableid" class="table table-bordered shadow">
                        <thead>
                            <tr>
                                <th scope="col">Employee ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Position</th>
                                <th scope="col">email</th>
                                <th scope="col">password</th>
                                <th scope="col">Photo</th>
                                <th scope="col"> Action </th>
                            </tr>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td class="hide-id"> <?php echo $row['id']; ?> </td>
                                <td> <?php echo $row['Employee_No']; ?> </td>
                                <td> <?php echo $row['first_name']; ?> </td>
                                <td><?php echo $row['last_name']; ?> </td>
                                <td> <?php echo $row['department']; ?> </td>
                                <td> <?php echo $row['position']; ?> </td>
                                <td> <?php echo $row['email']; ?> </td>
                                <td> <?php echo $row['password']; ?> </td>
                                <td> <img src="<?php echo $row['images']; ?>" alt="Image" class='img-thumbnail' width='50'>
                                <button type="button" class="btn btn-warning editImageBtn"><i class="lni lni-image"></i></button></td>
                                <td>
                

                                <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                                <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i></button>

                                <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i></button>

                                </td>
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
                    </table>
                </div>
            </div>


        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {
                $('#viewmodal').modal('show');
                $.ajax({ //create an ajax request to display.php
                    type: "GET",
                    url: "display.php",
                    dataType: "html", //expect html to be returned                
                    success: function (response) {
                        $("#responsecontainer").html(response);
                        //alert(response);
                    }
                });
            });

        });
    </script>


    <script>
        $(document).ready(function () {

            $('#datatableid').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Your Data",
                }
            });

        });
    </script>

<script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>

    <script>
        $(document).ready(function () {

            $('.editbtn').on('click', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#Employee_No').val(data[1]);
                $('#first_name').val(data[2]);
                $('#last_name').val(data[3]);
                $('#department').val(data[4]);
                $('#position').val(data[5]);
                $('#email').val(data[6]);
            });
        });
    </script>

   