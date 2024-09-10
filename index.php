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

                if ($row['status'] == "Inactive") {
                    echo '<script>';
                    echo 'document.addEventListener("DOMContentLoaded", function() {';
                    echo '  Swal.fire({
                                position: "top-end",
                                icon: "error",
                                title: "Your account is not active.",
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: "swal"
                            })';
                    echo '});';
                    echo '</script>';
                } else {
                    echo '<script>';
                    echo 'document.addEventListener("DOMContentLoaded", function() {';
                    echo '  Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Login Successfully",
                                showConfirmButton: false,
                                timer: 1500,
                                customClass: "swal"
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
            echo '  Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Incorrect Password",
                        showConfirmButton: false,
                        timer: 1500,
                        customClass: "swal"
                    })';
            echo '});';
            echo '</script>';
        }
    } else {
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo '  Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Incorrect Password",
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: "swal"
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
    <title>ASTRA</title>
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
    }

    #particles-js{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 100%;
    height: 100vh;
    z-index: -100;
    }
    .container{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: 400px;
        background-color: white;
        border-radius: 10px;
        padding: 5px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
    }
    .form-image{
        position: relative;
        left: -5px;
        top: -20px;
        width: 150px;
        height: 150px;
        margin: 0 auto;
        opacity: 0;
    }
    .form-label{
        font-weight: bold;
    }
    .form-control{
        border: 1px solid #141E46;
    }
    h1{
        position: relative;
        top: -50px;
        font-weight: 800;
        color: #141E46;
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
        color: #141E46;
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
</style>
<body>
    <div id="particles-js"></div>
    
    <div class="container">
        <div class="form-container">
            <center>
            <img class="form-image" src="img/logo1.png" alt="">
<!--             <h1>.Gems</h1> -->
            <form action="index.php" class="form-group" method="post">
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
    <script src="particle/particles.js"></script>
    <script src="particle/demo/js/app.js"></script>
</body>
</html>
 