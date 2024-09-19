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
                    <a href="index.php" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Timekeeping</a>
                    <a href="employees.php" class="nav-item nav-link"><i class="fa fa-users me-2"></i>Employees</a>
                    <a href="payroll.php" class="nav-item nav-link"><i class="fa fa-file-alt me-2"></i>Payroll</a>
                    <a href="attendance.php" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Attendances</a>
                    <a href="settings.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>My Profile</a>
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

            
            <div class="container-fluid p-4 h-80 mb-3">
                <div class="p-4 row text-center">
                    <div id="clock-date" class="clock clock-date col-12 col-md-12 col-lg-12 col-sm-4"></div>
                    <div id="clock-time" class="clock clock-time col-12 col-md-12 col-lg-12 col-sm-4"></div>
                </div>
                <div class="row p-4 d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-primary btn-lg col-lg-4 col-md-4 col-sm-12 " id="clock-btn">CLOCK IN</button>
                    <div id="elapsed-time" class="elapsed-time text-success"></div>
                    <input type="hidden" id="user_emp_no" value="<?php echo $user_id; ?>">
                </div>
            </div>

            <div class="row mb-3 p-4">
                <div class="col-sm-12 col-lg-6 col-md-6 col-xl-6">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">Calender</h6>
                            <a href="">Show All</a>
                        </div>
                        <div id="calender"></div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 col-md-6 col-xl-6">
                    <div class="h-100 bg-light rounded p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h6 class="mb-0">To Do List</h6>
                            <a href="">Show All</a>
                        </div>
                        <div class="d-flex mb-2">
                            <input class="form-control bg-transparent" type="text" placeholder="Enter task">
                            <button type="button" class="btn btn-primary ms-2">Add</button>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox" checked>
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span><del>Short task goes here...</del></span>
                                    <button class="btn btn-sm text-primary"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center border-bottom py-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center pt-2">
                            <input class="form-check-input m-0" type="checkbox">
                            <div class="w-100 ms-3">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <span>Short task goes here...</span>
                                    <button class="btn btn-sm"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
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

    <script>
    function updateClock() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var seconds = now.getSeconds();
        var day = now.getDate();
        var month = now.getMonth();
        var year = now.getFullYear();

        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;

        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;
        day = day < 10 ? '0' + day : day;

        var timeString = hours + ':' + minutes + ':' + seconds + ' ' + ampm;
        var dateString = monthNames[month] + ' ' + day  +  ' ' + year;

        document.getElementById('clock-date').textContent = dateString;
        document.getElementById('clock-time').textContent = timeString;
    }

    updateClock();
    setInterval(updateClock, 50);

    var clockButton = document.getElementById('clock-btn');
    var elapsedTimeDisplay = document.getElementById('elapsed-time');
    var startTime, intervalId;

    document.getElementById('clock-btn').addEventListener('click', function() {
    var clockButton = document.getElementById('clock-btn');
    var action = clockButton.textContent === 'CLOCK IN' ? 'clock_in' : 'clock_out';
    var emp_no = <?php echo $user_id; ?>;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', './functions/clock_in_out.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            if (action === 'clock_in') {
                clockButton.textContent = 'CLOCK OUT';
                startTime = new Date();
                intervalId = setInterval(updateElapsedTime, 1000);
                startAutoCapture(emp_no); // Start auto capture on clock in
            } else {
                clockButton.textContent = 'CLOCK IN';
                clearInterval(intervalId);
                elapsedTimeDisplay.textContent = '';
                stopAutoCapture(); // Stop auto capture on clock out
            }
        }
    };
    xhr.send('emp_no=' + emp_no + '&action=' + action);
});

function updateElapsedTime() {
    var now = new Date();
    var elapsed = new Date(now - startTime);

    var hours = Math.floor(elapsed / 3600000);
    var minutes = Math.floor((elapsed % 3600000) / 60000);
    var seconds = Math.floor((elapsed % 60000) / 1000);

    elapsedTimeDisplay.textContent = hours + 'h ' + minutes + 'm ' + seconds + 's';
}

var captureIntervalId;

function startAutoCapture(emp_no) {
    captureIntervalId = setInterval(function() {
        capturePhoto(emp_no);
    }, 1000);
}

function stopAutoCapture() {
    clearInterval(captureIntervalId);
}

function capturePhoto(emp_no) {
    const video = document.createElement('video');

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            video.play();
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            video.addEventListener('loadeddata', () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                canvas.toBlob(blob => {
                    const formData = new FormData();
                    formData.append('photo', blob, 'photo_' + emp_no + '_' + Date.now() + '.jpg');
                    formData.append('emp_no', emp_no); 
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', './functions/snapshot.php', true);
                    xhr.send(formData);
                }, 'image/jpeg');
                stream.getTracks().forEach(track => track.stop());
            });
        })
        .catch(error => {
            console.error('Error accessing camera:', error);
        });
}

function updateElapsedTime() {
    var now = new Date();
    var elapsed = new Date(now - startTime);

    var hours = Math.floor(elapsed / 3600000);
    var minutes = Math.floor((elapsed % 3600000) / 60000);
    var seconds = Math.floor((elapsed % 60000) / 1000);

    elapsedTimeDisplay.textContent = hours + 'h ' + minutes + 'm ' + seconds + 's';
}
</script>

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