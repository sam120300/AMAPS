<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require './connect/config.php';

        if (isset($_POST['next'])) {

            $emp_no = $_POST['employeeID'];
            $question1 = $_POST['qstn1'];
            $question2 = $_POST['qstn2'];
            $ans1 = $_POST['ans1'];
            $ans2 = $_POST['ans2'];

            $sql = "SELECT * FROM users WHERE emp_no = '$emp_no'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);

            if ($row > 0) {

                $rows = mysqli_fetch_assoc($result);

                $q1 = $rows['q1'];
                $q2 = $rows['q2'];
                $a1 = $rows['a1'];
                $a2 = $rows['a2'];
            
                if ($question1 == $q1 && $question2 == $q2 && $ans1 == $a1 && $ans2 == $a2) {
                    header('Location: changepass.php?id='. $emp_no);

                } else {
                    header('Location: forgotpass.php?id='. $emp_no);
                }
            }
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- #497384 -->
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <?php require_once 'links.php'; ?>
    <title>GEMS - Forgot Password</title>
</head>
<style> 

body{
  background-repeat: repeat;
  background-size: cover;
  background-position-y: -50px;
  background-attachment: fixed;
  background-color: whitesmoke;
  overflow: hidden;
}
.maincon{
    position: absolute;
    top: 50%;
    left: 75%;
    transform: translate(-50%, -50%);
    width: 500px;
    height: 100vh;
    background-color: #141E46;
}
button {
  padding: 17px 40px;
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
.forgot{
    position: absolute;
    top: 50%;
    left: 28%;
    transform: translate(-50%, -50%);
    width: 600px;
    height: 600px;
    align-items: center;
    filter: drop-shadow(-2px 10px 5px)
}
.back{
    text-decoration: none;
    color: white;
}
</style>
<body>
    <?php if (!isset($_POST['next'])) {?>
    <div class="container maincon">
        <form action="forgotpassword.php" method="POST" class="form" autocomplete="off">
                    <div class="title mt-5">
                        <p class="h4 text-center p-3 text-light">Forgot Password</p>
                    </div>
                    <div class="p-3">
                    <div class="EmployeeID col mb-2">
                        <input type="EmployeeID" name="employeeID" id="EmployeeID" placeholder="Employee ID" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="qstn1" class="col-xs-3 form-label text-light">Question 1:</label>
                        <select name="qstn1" class="form-select mb-2 w-100" aria-label="Default select example" required>
                            <option value="" disabled selected>Select Question</option>
                            <option value="What was your mother’s maiden name?">What was your mother’s maiden name?</option>
                            <option value="Where were you born?">Where were you born?</option>
                            <option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
                            <option value="What was the name of your elementary school?">What was the name of your elementary school?</option>
                            <option value="What high school did you attend?">What high school did you attend?</option>
                        </select>
                        <input type="text" name="ans1" id="ans1" placeholder="Your answer" class="form-control w-100" required>
                    </div>

                    <div class="mb-4">
                        <label for="qstn2" class="form-label col-xs-3 text-light">Question 2:</label>
                        <select name="qstn2" id="qstn2" class="mb-2 w-100 form-select">
                            <option value="" disabled selected>Select Question</option>
                            <option value="What Is your favorite book?">What Is your favorite book?</option>
                            <option value="What is the name of the road you grew up on?">What is the name of the road you grew up on?</option>
                            <option value="What was the name of your first/current/favorite pet?">What was the name of your first/current/favorite pet?</option>
                            <option value="What was the first company that you worked for?">What was the first company that you worked for?</option>
                            <option value="What is your favorite colour?">What is your favorite colour?</option>
                        </select>
                        <input type="text" name="ans2" id="ans2" placeholder="Your answer" class="form-control w-100">
                    </div>
                    <div class="r-pass row text-center">
                        <div class="mb-5">
                            <button class="w-75 h-100" type="submit" name="next">NEXT<i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                        <center>
                        <a class="back w-25" href="./"><i class="fa-solid fa-arrow-left"></i> Back</a>
                        </center>
                    </div>
                    </div>
                </form>
                <?php } ?>
        </div>
        <img class="forgot" src="./img/forgot.png" alt="">

</body>
<script>
    function login(){
        Swal.fire({
        position: "center",
        icon: "success",
        title: "Login Successful!",
        showConfirmButton: false,
        timer: 1500
        });
    }
    function register(){
        Swal.fire({
        position: "center",
        icon: "success",
        title: "Registration Successful!",
        showConfirmButton: false,
        timer: 1500
        });
    }
</script>
<script src="scripts/particles-js"></script>
</html>