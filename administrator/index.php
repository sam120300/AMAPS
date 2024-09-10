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
    <title>AMAPS - Timekeeping</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
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
.clock-container{
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    top: 50px;
}
.clock-date{
    font-size: 100px;
    font-weight: bold;
    color: #C70039;
    text-align: center;
    line-height: 100px;
    letter-spacing: 10px;
    width: 100%;
    margin-bottom: 30px;
}
.clock-time{
    position: relative;
    font-size: 100px;
    font-weight: bold;
    color: #141E46;
    text-align: center;
    line-height: 100px;
    letter-spacing: 10px;
    width: 100%;
}
.elapsed-time {
position: absolute;
top: 65%;
left: 50%;
transform: translate(-50%, -50%);
font-size: 24px;
font-weight: bold;
color: #141E46;
text-align: center;
width: 100%;
}

.my-btn {
padding: 40px 100px;
border-radius: 75px;
cursor: pointer;
border: 0;
background-color: #141E46;
box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
text-transform: uppercase;
font-size: 42px;
transition: all 0.5s ease;
color: white;
margin-top: 50px;
font-weight: bold;
}
.my-btn:hover {
letter-spacing: 5px;
background-color: #141E46;
color: hsl(0, 0%, 100%);
box-shadow: #141E46 0px 7px 29px 0px;
}
.my-btn:active {
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
                    <a href="../administrator/index.php" class="d-flex align-items-center list-group-item list-group-item-action activated">
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
                        <h1 class="navbar-brand">Timekeeping</h1>
                    </div>
                </nav>
                <div class="container clock-container">
                    <center>
                    <div id="clock-date" class="clock clock-date h2"></div>
                    <div id="clock-time" class="clock clock-time h2"></div>
                    <button type="submit" class="my-btn" id="clock-btn">CLOCK IN</button>
                    <div id="elapsed-time" class="elapsed-time text-success"></div>
                    </center>
                    <input type="hidden" id="user_emp_no" value="<?php echo $user_id; ?>">
                </div>
            </div>
        </div>
    </div>

    <video id="cameraPreview" autoplay style="display: none;"></video>
    <canvas id="photoCanvas" style="display: none;"></canvas>

<!-- Bootstrap Bundle with Popper -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome Icons -->
<script>
    document.getElementById('sidebar-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('collapsed');
        document.getElementById('main-content').classList.toggle('collapsed');
        document.querySelector('.avatar').classList.toggle('collapsed');
        document.querySelector('.sidebar-header').classList.toggle('collapsed');
        

        var listItems = document.querySelectorAll('.list-group-item');
        listItems.forEach(function(item) {
            item.classList.toggle('collapsed');
        });
    });


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
        var dateString = day + ' ' + monthNames[month] + ' ' + year;

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
    }, 600000); // Capture photo every 10 minutes
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
</body>
</html>
