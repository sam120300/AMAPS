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

if(isset($_POST['save_profile'])) {
    $emp_no = $_POST['emp_no'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Update user data in database
    $update_sql = "UPDATE users SET name='$name', email='$email' WHERE emp_no='$user_id'";
    mysqli_query($conn, $update_sql);
    
    // Handle password change if provided
    if(!empty($new_password) && ($new_password == $confirm_password)) {
        // Verify old password
        $verify_password_sql = "SELECT password FROM users WHERE emp_no='$user_id'";
        $result = mysqli_query($conn, $verify_password_sql);
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];
            if(password_verify($old_password, $hashed_password)) {

                $hashed_password_new = password_hash($new_password, PASSWORD_DEFAULT);
                $update_password_sql = "UPDATE users SET password='$hashed_password_new' WHERE emp_no='$user_id'";
                mysqli_query($conn, $update_password_sql);

                echo '<script>';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo '  Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Profile updated successfully!",
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: "swal"
                        }).then(function() {
                            window.location.href = "link4.php";
                        });';
                echo '});';
                echo '</script>';
            } else {
                echo '<script>';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo '  Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Error",
                            text: "Old password is incorrect.",
                            showConfirmButton: false,
                            timer: 1500,
                            customClass: "swal"
                        });';
                echo '});';
                echo '</script>';
            }
        } else {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '  Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Error retrieving user information.",
                        showConfirmButton: false,
                        timer: 1500,
                        confirmButtonColor: "#141E46",
                        customClass: "swal"
                    });';
            echo '});';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '  Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Error",
                    text: "New passwords is not match.",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: "swal"
                });';
        echo '});';
        echo '</script>';
    }
    
    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
        $avatar_tmp_name = $_FILES['avatar']['tmp_name'];
        $avatar_extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $avatar_name = $user_id . '.' . $avatar_extension;
        $avatar_path = "../uploads/avatar/" . $avatar_name;

        $_SESSION['user_data'] = array(
            'emp_no' => $user_id,
            'name' => $user_name,
            'email' => $user_email,
            'status' => $user_status,
            'avatar' => $avatar_path
        );
        
        if(move_uploaded_file($avatar_tmp_name, $avatar_path)) {
            $update_avatar_sql = "UPDATE users SET avatar='$avatar_path' WHERE emp_no='$user_id'";
            mysqli_query($conn, $update_avatar_sql);
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '  Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Profile updated successfully!",
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: "swal"
                    }).then(function() {
                        window.location.href = "link4.php";
                    });';
            echo '});';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '  Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: "Failed to move uploaded file.",
                        confirmButtonColor: "#141E46"
                    });';
            echo '});';
            echo '</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AMAPS - Settings</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        background-color: #141E46;
        color: hsl(0, 0%, 100%);
        box-shadow: #141E46 0px 0px 0px 0px;
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
                        if(isset($avatar)){
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
                    <a href="../administrator/attendance.php" class="d-flex align-items-center list-group-item list-group-item-action">
                        &nbsp<i class="fa-solid fa-user mr-3"></i><span class="text">Attendances</span>
                    </a>
                    <a href="../administrator/settings.php" class="d-flex align-items-center list-group-item list-group-item-action  activated">
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
                        <h1 class="navbar-brand">Edit Profile</h1>
                    </div>
                </nav>

                <main>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    ?>
                    <center>
                        <div class="container w-75 h-50 profile" style="padding: 10px;">
                            <div class="row" >
                                <div class="left col">
                                    <?php
                                        if(isset($user_data['avatar'])){
                                            echo '<img class="avatar avatar-preview" src="'. $avatar .'" alt="Avatar" style="width: 350px; height: 350px; border: 1px solid #141E46; border-radius: 25px;">';
                                        } else {
                                            echo '<img class="avatar avatar-preview" src="../assets/temp_avatar.png" alt="Avatar" style="width: 350px; height: 350px; border: 1px solid #141E46; border-radius: 25px;">';
                                        }
                                    ?>
                                </div>
                                <div class="right col">
                                    <div class="form">
                                        <form action="settings.php" method="post" class="text-start" enctype="multipart/form-data">
                                            <label for="" class="form-label">Employee ID</label>
                                            <input type="text" class="form-control" name="emp_no" value="<?php echo $row['emp_no']?>">
                                            <label for="" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" value="<?php echo $row['name']?>">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" value="<?php echo $row['email']?>">
                                            <label for="" class="form-label">Old Password</label>
                                            <input type="password" name="old_password" class="form-control">
                                            <label for="" class="form-label">New Password</label>
                                            <input type="password" name="new_password" class="form-control">
                                            <label for="" class="form-label">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control">
                                            <label for="" class="form-label">Avatar</label>
                                            <input type="file" name="avatar" accept="image/*" class="form-control">
                                            <center>
                                            <button type="submit" class=" mt-3" name="save_profile">Save Profile</button>
                                            </center>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </center>
                </main>
            </div>
            
        </div>
    </div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome Icons -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('input[type=file]').addEventListener('change', function() {
            var file = this.files[0];
            if(file) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    document.querySelector('.avatar-preview').setAttribute('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
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
