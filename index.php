<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require './connect/config.php';

if(isset($_POST['login'])){
    $user = $_POST['employeeID'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE emp_no = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $res = $result->fetch_assoc();
        if ($pass == $res['password']) {

            $_SESSION['emp_no'] = $user;

            $stmt = $conn->prepare("SELECT * FROM users WHERE emp_no = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                $_SESSION['user_data'] = array(
                    'emp_no' => $user,
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'status' => $row['status'],
                    'avatar' => $row['avatar']
                );
                $_SESSION['user'] = 1;

                if ($row['status'] == 0) {
                    echo '<script>';
                    echo 'document.addEventListener("DOMContentLoaded", function() {';
                    echo '  const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                            });
                            Toast.fire({
                            icon: "error",
                            title: "Your account is not yet Active"
                            })';
                    echo '});';
                    echo '</script>';
                } else {
                    echo '<script>';
                    echo 'document.addEventListener("DOMContentLoaded", function() {';
                    echo '  const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                            });
                            Toast.fire({
                            icon: "success",
                            title: "Signed in successfully"
                            }).then(function() {
                                window.location = "./administrator/index.php";
                            });';
                    echo '});';
                    echo '</script>';
                }

            } else {
                echo "User data not found";
            }
        } else {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '  const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                            });
                            Toast.fire({
                            icon: "error",
                            title: "Incorrect ID or Password"
                            })';
            echo '});';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '  const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                            });
                            Toast.fire({
                            icon: "error",
                            title: "Incorrect ID or Password"
                            });';
        echo '});';
        echo '</script>';
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Michelle Silver Lining Mental Health Counseling
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="astra_system/public/img/logo1.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include 'links.php' ?>
</head>
<style>
    body{
        overflow: hidden;
        background-image: url("img/bg.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-color: #495057;
        height: 100%;
        background-attachment: fixed;
        
    }
    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    }
    .form-label{
        font-weight: bold;
    }
    .form-control{
        border: 1px solid #141E46;
    }
    h1{
        position: relative;
        top: 10px;
        font-weight: 700;
        color: #fff;
    }
    .form-group{
        position: relative;
        top: -50px;
    }
    .forgot{
        position: relative;
        top: 20px;
        text-align: center;
        font-size: 14px;
        color: #1864ab;
        font-weight: 500;
        text-decoration: none;
        transition: all 500ms ease;
    }
    .forgot:hover{
        text-decoration: underline;
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
    background-color: #58ab8d;
    color: hsl(0, 0%, 100%);
    box-shadow: #58ab8d 0px 0px 0px 0px;
    transform: translateY(10px);
    transition: 100ms;
    }
    #particles-js{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100vh;
    }
    .title{
        font-family: "Poppins";
        color: #1971c2;
        font-size: 24px;
        font-weight: 600;
    }
    footer{
        position: absolute;
        top: 90%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90%;
        font-size: 14px;
        text-align: center;
        color: #1864ab;
    }
    /* Extra small devices (portrait phones, less than 576px) */
@media (max-width: 575.98px) {
    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    }

    h2.title {
        font-size: 20px;
    }

    button {
        padding: 8px 30px;
    }

    footer p {
        font-size: 10px;
        color: #1864ab;
    }
}

/* Small devices (landscape phones, 576px and up) */
@media (min-width: 576px) and (max-width: 767.98px) {
    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    }

    h2.title {
        font-size: 22px;
    }

    button {
        padding: 10px 40px;
    }

    footer p {
        font-size: 12px;
        color: #1864ab;
    }
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991.98px) {
    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    }

    h2.title {
        font-size: 24px;
    }

    footer p {
        font-size: 12px;
        color: #1864ab;
    }
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) {
    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background-color: rgba(255, 255, 255, 0.0);
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(5px);
        color: white;
    }

    h2.title {
        font-size: 24px;
    }

    footer p {
        font-size: 14px;
        color: #1864ab;
    }
}
.video-container {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
            z-index: -1;
        }

        /* Fullscreen video, responsive and centered */
        video {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            transform: translate(-50%, -50%);
        }

</style>
<body>
    <div class="video-container">
        <video autoplay muted loop>
            <source src="assets/eyes_bg.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>  
    
    <div class="container">
        <div class="form-container">
            <center>
            <h2 class="title mt-4">Michelle Silver Lining Mental Health Counseling</h2><br>
<!--             <h1>.Gems</h1> -->
            <form action="index.php" class="form-group mt-5" method="post">
                <label class="form-label w-75 text-start" for="employeeID">Employee No.</label>
                <input class="form-control w-75" type="text" id="username" name="employeeID" required>
                <label class="form-label w-75 text-start" for="password">Password:</label>
                <input class="form-control w-75 mb-3" type="password" id="password" name="password" required>
                <button class="w-75" type="submit" name="login" value="login">Login</button><br>
                <a href="./forgotpassword.php" class="forgot">Forgot Password?</a>
                <div id="error-message" class="text-danger"></div>
            </form>
            </center>
        </div>
    </div>
    <footer>
        <fieldset class="text-light footer">
            <legend align="center">
                <h1 style="color: #1864ab;">Highly Confidential</h1>
            </legend>
            <p>This website facility is for the use of authorized users only. All users of this website are subject to having all of their activities monitored and recorded. Any nefarious activity will be subject to legal action. Anyone using this system expressly consents to such monitoring and is advised that if such monitoring reveals possible evidence of criminal activity system personnel may provide the evidence of such monitoring to law enforcement officials.</p>
        </fieldset>
    </footer>

    <script src="particle/particles.js"></script>
    <script src="particle/demo/js/app.js"></script>
</body>
<script>
    // Disable zooming using Ctrl + Scroll
    document.addEventListener('wheel', function(e) {
        if (e.ctrlKey) {
            e.preventDefault();
        }
    }, { passive: false });

    // Disable zooming using Ctrl + '+' and Ctrl + '-'
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '0')) {
            e.preventDefault();
        }
    });
</script>
</html>
 