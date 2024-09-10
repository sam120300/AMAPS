<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../connect/config.php';

if(isset($_SESSION['user_data'])) {
    $user_data = $_SESSION['user_data'];
    $user_id = $user_data['emp_no'];
    $user_name = $user_data['name'];
    $user_email = $user_data['email'];
    $user_status = $user_data['status'];
    $avatar = $user_data['avatar'];

} else {
    header("Location: ../");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AMAPS - Employees</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <?php include '../links.php' ?>
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
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            text-decoration: none;
            color: #141E46;
            border: 1px solid #141E46;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .pagination a.active {
            background-color: #141E46;
            color: #fff;
        }

        .pagination .arrow {
            padding: 10px;
            border: 1px solid #141E46;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .card{
            height: fit-content;
        }
        .side-inner{
        overflow: hidden;
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
                    <a href="../administrator/employees.php" class="d-flex align-items-center list-group-item list-group-item-action activated">
                        &nbsp<i class="fa-solid fa-users mr-3"></i><span class="text">Employees</span>
                    </a>
                    <a href="../administrator/payroll.php" class="d-flex align-items-center list-group-item list-group-item-action">
                        &nbsp<i class="fa-solid fa-money-check-dollar mr-3"></i><span class="text">Payroll</span>
                    </a>
                    <a href="../administrator/attendance.php" class="d-flex align-items-center list-group-item list-group-item-action">
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
                        <h1 class="navbar-brand">Employee List</h1>
                    </div>
                </nav>

                <main>
                    <center>
                        <div class="container mb-3 mt-3">
                        <form action="ratesfunctions/upload_rates.php" class="input-group" method="post" name="upload_excel" enctype="multipart/form-data" autocomplete="off">
                      <a class="rbtn btn btn-secondary" data-bs-toggle="modal" data-bs-target="#info-modal" style="background-color: whitesmoke; border: 1px solid #141E46; color: gray;"><i class="fa-solid fa-circle-question"></i></a>
                      <input type="file" id="file" name="file" accept=".csv" style="border: 1px solid #141E46;" class="form-control" required>
                      <button class="rbtn btn btn-primary" type="submit" name="upload" value="upload" style="background-color: whitesmoke; border: 1px solid #141E46; color: #141E46;"><i class="fa fa-file-import"></i></button>
                      <button class="rbtn btn btn-success text-success" type="button" data-bs-toggle="modal" data-bs-target="#updatemodal" style="background-color: whitesmoke; border: 1px solid #141E46; color: #4CA771;"><i class="fa fa-plus"></i></button>
                      <button class="rbtn btn btn-danger" style="background-color: whitesmoke; border:1px solid #141E46; color: #C70039;" id="delete" name="delete" type="button" data-bs-toggle="modal" data-bs-target="#CommaSeparatedDelete" ><i class="fa fa-trash"></i></button>
                      <button class="rbtn btn btn-danger" id="delete" name="delete" type="button" data-bs-toggle="modal" data-bs-target="#deleteAllModal" style="background-color: whitesmoke; border:1px solid #141E46; color: #C70039;"><i class="fa fa-trash"></i> Delete All</button>
              </form>
            </div>
                    <div class="site-section">
                        <div class="container fade-in-fwd">
                            <div class="card">
                                <div class="card-header" style="background-color: #141E46;">
                                <span class="h5 text-light"><i class="fa-solid fa-table-list mr-3"></i> Employees</span>
                                </div>
                                <div class="card-body">
                                <div class="row">
                                <div class="form-group col-2">
                                    <select class="form-select" name="state" id="maxRows" onchange="changeMaxRows()">
                                        <option value="" selected disabled>No. of rows</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="500">500</option>
                                        <option value="1000">1000</option>
                                        <option value="2000">2000</option>
                                        <option value="5000">Show ALL Rows</option>
                                    </select>
                                </div>
                                
                                <div class="form-group col-2">
                                <a href="./link3.php" class="btn btn-warning " style="width: 112px" ><i class="fa-solid fa-arrow-rotate-left"></i> Reset</a>
                                </div>
                                <div class="col"></div>
                                <div class="form-group col-3">
                                    <input type="text" id="myInput" onkeyup="debounceSearch()" placeholder="Search..." class="form-control">
                                </div>
                                <?php
                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
                                $start = ($page - 1) * $limit;
                                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

                                if (!empty($search)) {
                                    $sql = "SELECT * FROM users WHERE emp_no LIKE '%$search%' ORDER BY emp_no ASC LIMIT $start, $limit";
                                    $total_sql = "SELECT COUNT(*) FROM users WHERE emp_no LIKE '%$search%'";
                                } else {
                                    $sql = "SELECT * FROM users ORDER BY status ASC LIMIT $start, $limit";
                                    $total_sql = "SELECT COUNT(*) FROM users";
                                }
                                
                                if ($result = mysqli_query($conn, $sql)) {
                                    if (mysqli_num_rows($result) > 0) {
                                        echo '
                                        <table class="table table-sm table-striped table-hover table-responsive wrap" style="width: 100%;" id="table-id">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Avatar</th>
                                                <th class="text-center">Employee ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">E-mail</th>
                                                <th class="text-center">Position</th>
                                                
                                                <th class="text-center">Rate per hour</th>
                                                <th class="text-center">Shift</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Actions</th>
                                            </tr>
                                        </thead>';
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<tbody>';
                                            echo "<tr>";
                                            echo "<td class='text-center'><img style='width: 40px; height: 40px; border-radius: 50%;' src='".$row['avatar']."' alt=''></td>";
                                            echo "<td class='text-center'>".$row['emp_no']."</td>";
                                            echo "<td class='text-center'>".$row['name']."</td>";
                                            echo "<td class='text-center'>".$row['email']."</td>";
                                            echo "<td class='text-center'>".$row['position']."</td>";
                                            echo "<td class='text-center'>".$row['rate']."$</td>";
                                            echo "<td class='text-center'>".$row['shift']."</td>";
                                            echo "<td class='text-center'>";
                                                if ($row['status'] == 0){
                                                echo '<p class="text-danger"><i class="fa-solid fa-hand"></i><b></b></p>';
                                                } else {
                                                echo '<p class="text-success"><i class="fa-solid fa-circle-check"></i><b></b></p>';
                                                }
                                            echo "</td>";
                                            
                                            echo "<td class='text-center'>";
                                                echo '<div class="dropdown">';
                                                    echo '<button class="btn dropdown-toggle" type="button" data-toggle="dropdown"></button>';
                                                    echo'
                                                    <ul class="dropdown-menu row">';
                                                    if ($row['status'] == 0){
                                                        echo '<li class="col mb-1"><a method="GET" href="administrator.php?id=' . $row['id'] . '" class="btn btn-outline-success col" title="Delete Record"><i class="fa-solid fa-check"></i><b> VERIFY</b></a></li>';
                                                    } else {
                                                        echo '<li class="col mb-1"><a method="GET" href="administrator.php?id=' . $row['id'] . '" class="btn btn-outline-danger col" title="Delete Record"><i class="fa-solid fa-hand"></i><b> HOLD</b></a></li>';
                                                    }
                                                    echo' </ul>';
                                                echo '</div>';
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                        echo "</table>";

                                        $result_total = mysqli_query($conn, $total_sql);
                                        $total_records = mysqli_fetch_array($result_total)[0];
                                        $total_pages = ceil($total_records / $limit);

                                        echo '<div class="pagination">';
                                        if ($page > 1) {
                                            echo '<a href="?page=' . ($page - 1) . '&limit=' . $limit . '&search=' . $search . '" class="arrow">&#9665;</a>';
                                        }
                                        $startPage = max($page - 2, 1);
                                        $endPage = min($startPage + 4, $total_pages);

                                        for ($i = $startPage; $i <= $endPage; $i++) {
                                            echo '<a href="?page=' . $i . '&limit=' . $limit . '&search=' . $search . '" class="' . ($page == $i ? 'active' : '') . '">' . $i . '</a>';
                                        }
                                        if ($page < $total_pages) {
                                            echo '<a href="?page=' . ($page + 1) . '&limit=' . $limit . '&search=' . $search . '" class="arrow">&#9655;</a>';
                                        }
                                        echo '</div>';

                                        mysqli_free_result($result);
                                    }  else {
                                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                    }
                                    
                                }  else {
                                    echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                                }
                                ?>
                                </div>
                            </div>
                        </div> 
                    </div>  
                    </center>
                </main>
            </div>
        </div>
    </div>

    <script src="../template/js/jquery-3.3.1.min.js"></script>
    <script src="../template/js/popper.min.js"></script>
    <script src="../template/js/bootstrap.min.js"></script>
    <script src="../template/js/main.js"></script>
    <script>
      new DataTable('#table-id', {
         deferRender: true,
         processing: true,
         ordering: true,
         scroller: true,
         scrollY: 200,
         searching: false,
         paging: false,
         reponsive: true
      });
   </script>
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

    function changeMaxRows() {
  var maxRowsSelect = document.getElementById("maxRows");
  var maxRows = maxRowsSelect.value;

  maxRowsSelect.options[maxRowsSelect.selectedIndex].text =
    "Show " + maxRows + " Rows";

  event.preventDefault();

  window.location.href = window.location.pathname + "?page=1&limit=" + maxRows;
}

function debounce(func, wait) {
  let timeout;
  return function(...args) {
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(this, args), wait);
  };
}

function searchFunction() {
  var input = document.getElementById("myInput").value;
  window.location.href = "link3.php?search=" + input;
}
const debounceSearch = debounce(searchFunction, 1000);
    </script>
</body>
</html>
