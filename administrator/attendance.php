
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../connect/config.php';

if(isset($_SESSION['user_data'])) {
    $user_data = $_SESSION['user_data'];
    $user_id = $user_data['emp_no'];
    $user_name = $user_data['name'];
    $user_email = $user_data['email'];
    $avatar = $user_data['avatar'];
  } else {
    header("Location: ../");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AMAPS - Attendances</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<style>
        body{
            background-color: #F1f1f1;
            color: #141E46;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.7;
            letter-spacing: 0.025em;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 100;
            width: 210px; /* Sidebar width */
            padding: 50px 0 0; /* Adjust padding based on your needs */
            background-color: #141E46; /* Sidebar background color */
            transition: all 0.5s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: #f1f1f1;
        }
        .sidebar.collapsed {
            width: 80px; /* Collapsed sidebar width */
            overflow-x: hidden;
            transition: all 0.5s ease;
        }
        .list-group-item i {
            position: relative;
            margin-right: 10px; /* Space between icon and text */
        }
        .list-group-item .text {
            transition: all 0.5s ease;
        }
        .list-group-item.collapsed .text {
            display: none;
            transition: all 0.5s ease;
        }
        .main-content {
            margin-left: 200px; /* Adjust according to sidebar width */
            padding: 20px; /* Adjust padding based on your needs */
            transition: all 0.5s ease;
            overflow: hidden;
        }
        .main-content.collapsed {
            margin-left: 80px; /* Adjust margin for collapsed sidebar */
        }
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            transition: all 0.5s ease;
        }
        .sidebar-header.collapsed {
            text-align: center;
            padding: 15px 0;
            position: absolute;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .sidebar-header.collapsed p {
            display: none;
            transition: all 0.5s ease;
        }
        .avatar.collapsed {
            transform: scale(0.5);

        }
        .toggle-btn {
            margin-right: 10px;
            background-color: #141E46;
        }
        .toggle-btn:hover {
            background-color: #141E46;
            color: #FF6969;
        }
        .list-group{
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }
        .list-group-item {
            position: relative;
            padding: 10px 24px;
            border: none;
            background-color: #141E46;
            color: #FFF5E0;
        }
        .list-group-item:hover {
            color: #FF6969;
            background-color: #141E46;
        }
        .activated{
            color: #FF6969;
        }
        .navbar{
            background-color: #f1f1f1;
        }
        button {
        padding: 10px 40px;
        border-radius: 50px;
        cursor: pointer;
        border: 0;
        background-color: #C70039;
        box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
        text-transform: uppercase;
        font-size: 15px;
        transition: all 0.5s ease;
        color: white;
        }
        button:hover {
        letter-spacing: 5px;
        background-color: #C70039;
        color: hsl(0, 0%, 100%);
        box-shadow: #C70039 0px 7px 29px 0px;
        }
        button:active {
        letter-spacing: 1px;
        background-color: #C70039;
        color: hsl(0, 0%, 100%);
        box-shadow: #C70039 0px 0px 0px 0px;
        transform: translateY(10px);
        transition: 100ms;
        }
  </style>
<body>
<div class="container-fluid">
        <div class="row">
        <div class="col-auto sidebar" id="sidebar">
                <div class="sidebar-header">
                    <center>
                        <?php
                        if(isset($user_data['avatar'])){
                            echo '<img src="'. $avatar .'" alt="User Avatar" class="avatar mb-2">';
                        } else {
                            echo '<img src="../assets/temp_avatar.jpg" alt="User Avatar" class="avatar mb-2">';
                        }
                        ?>
                        
                        <p><?php echo $user_id; ?></p>
                    </center>
                </div>
                <div class="list-group">
                    <a href="../administrator/index.php" class="d-flex align-items-center list-group-item list-group-item-action">
                        &nbsp<i class="fa-solid fa-clock mr-3"></i><span class="text">Timekeeping</span>
                    </a>
                    <a href="../administrator/employees.php" class="d-flex align-items-center list-group-item list-group-item-action">
                        &nbsp<i class="fa-solid fa-users mr-3"></i><span class="text">Employees</span>
                    </a>
                    <a href="../administrator/payroll.php" class="d-flex align-items-center list-group-item list-group-item-action">
                        &nbsp<i class="fa-solid fa-money-check-dollar mr-3"></i><span class="text">Payroll</span>
                    </a>
                    <a href="../administrator/attendance.php" class="d-flex align-items-center list-group-item list-group-item-action activated">
                        &nbsp<i class="fa-solid fa-user mr-3"></i><span class="text">Attendances</span>
                    </a>
                    <a href="../administrator/settings.php" class="d-flex align-items-center list-group-item list-group-item-action">
                        &nbsp<i class="fa-solid fa-gear mr-3"></i><span class="text">Settings</span>
                    </a><br><br><br>
                    <a href="../administrator/functions/logout.php" class="d-flex align-items-center list-group-item list-group-item-action bg-danger">
                        &nbsp<i class="fa-solid fa-power-off"></i><span class="text">Logout</span>
                    </a>
                </div>
                
            </div>

            <!-- Main Content -->
            <div class="col main-content" id="main-content">
                <nav class="navbar">
                    <div class="container-fluid header-bar">
                        <button class="btn btn-secondary toggle-btn" id="sidebar-toggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="navbar-brand">Attendances</h1>
                    </div>
                </nav>

                <div class="container" style="width: 450px; height: 250px; background-color: #141E46; border-radius: 15px; padding: 20px;">
                    <form action="" method="get" class="">
                        <label for="" class="form-label text-light">Date From</label>
                        <input type="date" class="form-control">
                        <label for="" class="form-label text-light">Date To</label>
                        <input type="date" class="form-control mb-3">
                        <button type="submit" class="w-100"><i class="fa fa-eye fa-xxl"> </i> View Attendance</button>
                    </form>
                </div>
                <!-- <div class="container">
                <center>
                    <table class="table table-resposive table-success table-striped text-center mt-5">
                        <?php 
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            echo '
                            <thead>
                            <th>ID</th>
                            <th>Employee No</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                            </thead>
                            ';
                        }
                        ?>
                            <?php
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tbody>";
                                    echo "<td class='text-center'>".$row['id']."</td>";
                                    echo "<td class='text-center'>".$row['emp_no']."</td>";
                                    echo "<td class='text-center'>".$row['name']."</td>";
                                    echo "<td class='text-center'>".$row['position']."</td>";
                                    echo "<td class='text-center'>".$row['email']."</td>";
                                    echo "<td class='text-center'>".$row['status']."</td>";
                                    echo "<td class='text-center'>
                                            <a href='edit_employee.php?id=".$row['id']."' data-bs-toggle='modal' data-bs-target='#editmodal'><i class='fas fa-pencil-alt'></i></a>
                                            <a href='delete_employee.php?id=".$row['id']."' data-bs-toggle='modal' data-bs-target='#deletemodal'><i class='fas fa-trash-alt'></i></a>
                                        </td>";
                                    
                            }
                            echo "</tbody>";
                            ?>
                    </table>
                </center>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.getElementById('main-content').classList.toggle('collapsed');
        document.querySelector('.avatar').classList.toggle('collapsed');
        document.querySelector('.sidebar-header').classList.toggle('collapsed');
        
        // Toggle visibility of text in list items
        var listItems = document.querySelectorAll('.list-group-item');
        listItems.forEach(function(item) {
            item.classList.toggle('collapsed');
        });
    });
</script>
</body>
</html>
