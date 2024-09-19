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
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>Silver Lining</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <?php
                        if(isset($user_data['avatar'])){
                            echo '<img class="rounded-circle" src="'.$avatar.'" alt="" style="width: 40px; height: 40px;">';
                        } else {
                            echo '<img src="../assets/temp_avatar.jpg" alt="User Avatar" class="avatar mb-2">';
                        }
                        ?>
                        
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $user_name; ?></h6>
                        <span><?php echo $user_id; ?></span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Timekeeping</a>
                    <a href="employees.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Employees</a>
                    <a href="payroll.php" class="nav-item nav-link"><i class="fa fa-file-alt me-2"></i>Payroll</a>
                    <a href="attendance.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Attendances</a>
                    <a href="settings.php" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>My Profile</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        <?php
                        if(isset($user_data['avatar'])){
                            echo '<img class="rounded-circle" src="'.$avatar.'" alt="" style="width: 40px; height: 40px;">';
                        } else {
                            echo '<img src="../assets/temp_avatar.jpg" alt="User Avatar" class="avatar mb-2">';
                        }
                        ?>
                            <span class="d-none d-lg-inline-flex"><?php echo $user_name; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="functions/logout.php" class="dropdown-item text-danger">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            
                    <div class="row mb-3 p-4">
                        <div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Responsive Table</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Country</th>
                                            <th scope="col">ZIP</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>John</td>
                                            <td>Doe</td>
                                            <td>jhon@email.com</td>
                                            <td>USA</td>
                                            <td>123</td>
                                            <td>Member</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>mark@email.com</td>
                                            <td>UK</td>
                                            <td>456</td>
                                            <td>Member</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>jacob@email.com</td>
                                            <td>AU</td>
                                            <td>789</td>
                                            <td>Member</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
            
                    <div class="row p-4">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">PAYROLL</h6>
                            <form>
                                <div class="mb-3 row">
                                    <div class="col-6 col-ms-12 col-md-6 col-lg-6">
                                        <label for="date_from" class="form-label">Date From:</label>
                                        <input type="date" class="form-control" id="date_from">
                                    </div>
                                    <div class="col-6 col-ms-12 col-md-6 col-lg-6">
                                        <label for="date_to" class="form-label">Date To:</label>
                                        <input type="date" class="form-control" id="date_to">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary col-6">View Payroll</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">ATTENDANCE</h6>
                            <form>
                                <div class="mb-3 row">
                                    <div class="col-6 col-ms-12 col-md-6 col-lg-6">
                                        <label for="date_from" class="form-label">Date From:</label>
                                        <input type="date" class="form-control" id="date_from">
                                    </div>
                                    <div class="col-6 col-ms-12 col-md-6 col-lg-6">
                                        <label for="date_to" class="form-label">Date To:</label>
                                        <input type="date" class="form-control" id="date_to">
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary col-6">View Attendance</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    

            <video id="cameraPreview" autoplay style="display: none;"></video>
            <canvas id="photoCanvas" style="display: none;"></canvas>


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            <span>2024 </span>&copy; <a href="#">Michelle Silver Lining Mental Health Counseling</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/chart/chart.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/waypoints/waypoints.min.js"></script>
    <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../lib/tempusdominus/js/moment.min.js"></script>
    <script src="../lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../js/main.js"></script>
    
</body>

</html>