<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require './connect/config.php';

if(isset($_POST['login'])){
  $user = $_POST['employeeID'];
  $pass = md5($_POST['password']);

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
                  'password' => $row['password'],
                  'user_type' => $row['user_type'],
                  'firstname' => $row['firstname'],
                  'lastname' => $row['lastname'],
                  'email' => $row['email'],
              );
              $_SESSION['user'] = 1;
              
              if ($row['status'] == 0){
                echo '
                <script>
                toastr.error("Your account is on hold.");
                </script>
                ';
                
              } else {
                header("Location: ./hr/index.php"); 
              }

          } else {
              echo "User data not found";
          }
      } else {
          echo "<script>alert(\"Login Failed\");</script>";
          header("Location: ./"); 
      }
  } else {
      echo "<script>alert(\"Login Failed\");</script>";
      header("Location: ./");
  }

  $stmt->close();
}

if(isset($_POST['register'])){
      $emp_no = $firstname = $lastname = $email = $password = $confirmpassword = $question1 = $answer1 = $question2 = $answer2 = "";
      $emp_no_err = $firstname_err = $lastname_err = $email_err = $password_err = $confirmpassword_err = $question1_err = $answer1_err = $question2_err = $answer2_err = "";
      
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          $input_emp_no = trim($_POST["reg_employeeID"]);
          if(empty($input_emp_no)){
              $emp_no_err = "Please enter your employee ID.";     
          } else{
              $emp_no = $input_emp_no;
          }

          $input_firstname = trim($_POST["fname"]);
          if(empty($input_firstname)){
              $firstname_err = "Please enter your First Name. ";     
          } else{
              $firstname = $input_firstname;
          }
          
          $input_lastname = trim($_POST["lname"]);
          if(empty($input_lastname)){
              $lastname_err = "Please enter your Last Name.";     
          } else{
              $lastname = $input_lastname;
          }

          $input_email = trim($_POST["email"]);
          if(empty($input_email)){
              $email_err = "Please enter your E-mail.";     
          } else{
              $email = $input_email;
          }

          $input_password = trim($_POST["reg_password"]);
          if(empty($input_password)){
              $password_err = "Please enter your password.";     
          } else{
              $password = $input_password;
          }
          
          $input_confirmpassword = trim($_POST["reg_confirmpassword"]);
          if(empty($input_confirmpassword)){
              $confirmpassword_err = "Please confirm your password";     
          } else{
              $confirmpassword = $input_confirmpassword;
          }

          $input_question1 = trim($_POST["q1"]);
          if(empty($input_question1)){
              $question1_err = "Please enter your question 1.";     
          } else{
              $question1 = $input_question1;
          }

          $input_answer1 = trim($_POST["a1"]);
          if(empty($input_answer1)){
              $answer1_err = "Please enter your answer 1.";     
          } else{
              $answer1 = $input_answer1;
          }

          $input_question2 = trim($_POST["q2"]);
          if(empty($input_question2)){
              $question2_err = "Please enter your question 2.";     
          } else{
              $question2 = $input_question2;
          }

          $input_answer2 = trim($_POST["a2"]);
          if(empty($input_answer2)){
              $answer2_err = "Please enter your answer 2.";     
          } else{
              $answer2 = $input_answer2;
          }
          
          if(empty($emp_no_err) && empty($password_err) && empty($confirmpassword_err) && empty($firstname_err) && empty($lastname_err) && empty($email_err) && empty($question1_err) && empty($answer1_err) && empty($question2_err) && empty($answer2_err)){
              $sql = "INSERT INTO users (emp_no, firstname, lastname, email, password, q1, a1, q2, a2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
              
              if($stmt = mysqli_prepare($conn, $sql)){
                  mysqli_stmt_bind_param($stmt, "sssssssss", $param_emp_no, $param_firstname, $param_lastname, $param_email, $param_password, $param_question1, $param_answer1, $param_question2, $param_answer2);

                  $data = '';


                  $param_emp_no = $emp_no;
                  $param_firstname = $firstname;
                  $param_lastname = $lastname;
                  $param_email = $email;
                  $param_password = md5($password);
                  $param_question1 = $question1;
                  $param_answer1 = $answer1;
                  $param_question2 = $question2;
                  $param_answer2 = $answer2;
                  
              /* $qry = "SELECT * FROM users WHERE emp_no = '$param_emp_no'";
              $qry2 = "SELECT * FROM emplist WHERE staff_code = '$input_emp_no'";
                if (($check = mysqli_query($conn, $qry)) || ($check2 = mysqli_query($conn, $qry2))) {
                  if (mysqli_num_rows($check) > 0) {
                    echo '<script> alert("Already Registered!"); </script>';
                  } elseif (mysqli_num_rows($check2) > 0) {
                    echo '<script> alert("ID is not registered in the database!"); </script>';
                  } else {
                    if(mysqli_stmt_execute($stmt)){
                        echo '<script> alert("Registered Successfully!"); </script>';
                        header("location: index.php");
                        exit();
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                  }
                }
              } */
              $qry1 = "SELECT * FROM users WHERE emp_no = '$param_emp_no'";
              $qry2 = "SELECT * FROM emplist WHERE emp_no = '$input_emp_no'";
              $res1 = mysqli_query($conn, $qry1);
              $res2 = mysqli_query($conn, $qry2);

              if ((mysqli_num_rows($res1) > 0)){
                echo '<script> alert("Already Registered!"); </script>';
                header("location: index.php");
              } elseif ( (mysqli_num_rows($res2) == 0)) {
                echo '<script> alert("ID is not registered in the database!"); </script>';
                header("location: index.php");
              } else {
                mysqli_stmt_execute($stmt);
                echo '<script> alert("Registered Successfully!"); </script>';
                header("location: index.php");
              }
            
              mysqli_stmt_close($stmt);
            }}
      
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
    <title>Accrue</title>
</head>
<style> 

.form {
  display: flex;
  flex-direction: column;
  gap: 14px;
  padding: 24px;
}

#chk {
  display: none;
}

.login {
  position: relative;
  width: 100%;
  height: 100%;
}

.login label {
  margin: 4% 0 14%;
}

label {
  color: #497384;
  font-size: 2rem;
  justify-content: center;
  display: flex;
  font-weight: bold;
  cursor: pointer;
  transition: .5s ease-in-out;
}

.loginput {
  width: 75%;
  height: 40px;
  background: transparent;
  padding: 10px;
  border: 1px solid #497384;
  outline: none;
  border-radius: 4px;
  background-color: white;
}

.reginput {
  width: 75%;
  height: 40px;
  background: #f8f9fa;
  padding: 10px;
  border: 1px solid gray;
  outline: none;
  border-radius: 4px;
}


/*Register*/
.register {
  background: transparent;
  border-radius: 20% / 10%;
  transform: translateY(-2%);
  transition: .8s ease-in-out;
}

.register label {
  color: #497384;
  transform: scale(.6);
}

#chk:checked ~ .register {
  transform: translateY(-74%);
  border-top: 1px solid #497384;
  background-color: #497384;
}
#chk:checked ~ .register .cont{
  overflow-y: scroll;
  height: 200px;
  max-height: 200px;
}

#chk:checked ~ .register label {
  transform: scale(1);
  margin: 6% 0 2%;
  color: white;
}

#chk:checked ~ .login label {
  transform: scale(0.5);
  margin: 5% 0 13%;
}   
/*Button*/
.loginbtn {
  width: 85%;
  height: 40px;
  margin: 12px auto 10%;
  color: #fff;
  background: #497384;
  font-size: 1rem;
  font-weight: bold;
  border: none;
  border-radius: 50px;
  cursor: pointer;
  transition: .2s ease-in;
}

.loginbtn:hover {
  transform: scale(1.1);
}

.regbtn {
  width: 85%;
  height: 40px;
  margin: 12px auto 10%;
  color: #497384;
  background: #fff;
  font-size: 1rem;
  font-weight: bold;
  border: none;
  border-radius: 50px;
  cursor: pointer;
  transition: .2s ease-in;
}

.regbtn:hover {
  transform: scale(1.1);
}

.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.main {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 450px;
  height: 500px;
  overflow: hidden;
  border-radius: 25px;
  box-shadow: 1px 1px 5px -1px #0a0a0a;
  border: 1px solid white;
  backdrop-filter: blur(5px);
}

.icon {
  width: 3em;
  margin-top: -1em;
  padding-bottom: 1em;
}

.logo{
  width: 150px;
  height: 70px;
  margin-top: -100px;
  margin-bottom: -150px;
}

body{
  background-repeat: repeat;
  background-size: cover;
  background-position-y: -50px;
  background-attachment: fixed;
  background-color: whitesmoke;
  overflow: hidden;
}

#particles-js{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 100vh;
}

button {
  padding: 17px 40px;
  border-radius: 50%;
  cursor: pointer;
  border: 0;
  background-color: white;
  box-shadow: rgb(0 0 0 / 5%) 0 0 8px;
  text-transform: uppercase;
  font-size: 15px;
  transition: all 0.5s ease;
}

button:hover {
  letter-spacing: 5px;
  background-color: #58ab8d;
  color: hsl(0, 0%, 100%);
  box-shadow: #58ab8d 0px 7px 29px 0px;
}

button:active {
  letter-spacing: 1px;
  background-color: #58ab8d;
  color: hsl(0, 0%, 100%);
  box-shadow: #58ab8d 0px 0px 0px 0px;
  transform: translateY(10px);
  transition: 100ms;
}

</style>
<body class="">
    <div id="particles-js"></div>

    
    <div class="container">
            <div class="main">  	
                    <input type="checkbox" id="chk" aria-hidden="true">
                    <div class="login">
                        <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" class="form was-validated" autocomplete="off">
                        <center>
                          <img  class="logo" src="assets/acc_logo.png" alt="" style="transform: scale(1.5); position: relative; left: 15px; height: 76px">
                        </center>
                            
                            <center>
                            <label class="mb-6" for="chk" aria-hidden="true" style=" position: relative; top: 50px; width: fit-content">LOGIN</label>
                            <input class="input loginput mb-3" type="text" name="employeeID" placeholder="Employee ID" required="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly')">
                            <input class="input loginput password" type="password" name="password" placeholder="Password" required="" autocomplete="off">
                            <button class="w-75 h-100 loginbtn" type="submit" name="login">Sign-in</button>
                            <a href="forgotpass.php" style="text-decoration: none; position: relative; top: -20px; color: #497384;">Forgot&nbsppassword?</a>
                            </center>
                            
                        </form>
                    </div>
                    <div class="register">
                        <form action="<?=$_SERVER['PHP_SELF'];?>" method="POST" class="form was-validated" autocomplete="off">
                            <center>  
                            <label class="mb-3 mt-1" for="chk" aria-hidden="true" style="width: fit-content" onClick="toggleMenu()">REGISTER</label>
                              <div class="cont">
                                <input class="input reginput mb-3" type="text" name="reg_employeeID" placeholder="Employee ID" required="">
                                <input class="input reginput mb-3" type="text" name="fname" placeholder="First name" required="">
                                <input class="input reginput mb-3" type="text" name="lname" placeholder="Last name" required="">
                                <input class="input reginput mb-3" type="email" name="email" placeholder="E-mail" required="">
                                <input class="input reginput mb-3" type="password" name="reg_password" placeholder="Password" required="">
                                <input class="input reginput mb-3" type="password" name="reg_confirmpassword" placeholder="Confirm Password" required="">
                                <hr>
                                <span>Security Quesions</span>
                                <select name="q1" id="question1" class="form-select input reginput mb-3">
                                    <option value="Please select" disabled selected>Question 1: Please select</option>
                                    <option value="What was your mother’s maiden name?">What was your mother’s maiden name?</option>
                                    <option value="Where were you born?">Where were you born?</option>
                                    <option value="What is the name of your favorite pet?">What is the name of your favorite pet?</option>
                                    <option value="What was the name of your elementary school?">What was the name of your elementary school?</option>
                                    <option value="What high school did you attend?">What high school did you attend?</option>
                                </select>
                                <input class="input reginput mb-3" type="text" name="a1" placeholder="Answer 1" required="">

                                <select name="q2" id="question2" class="form-select input reginput mb-3">
                                    <option value="" disabled selected>Question 2: Please select</option>
                                    <option value="What Is your favorite book?">What Is your favorite book?</option>
                                    <option value="What is the name of the road you grew up on?">What is the name of the road you grew up on?</option>
                                    <option value="What was the name of your first/current/favorite pet?">What was the name of your first/current/favorite pet?</option>
                                    <option value="What was the first company that you worked for?">What was the first company that you worked for?</option>
                                    <option value="What is your favorite colour?">What is your favorite colour?</option>
                                </select>
                                <input class="input reginput mb-3" type="text" name="a2" placeholder="Answer 2" required="">
                              </div>

                            </center>
                            <button class="w-75 h-100 regbtn" type="submit" name="register" onclick="register()">Register</button>
                        </form>
                    </div>
            </div>
    </div>

</body>
<script src="particle/particles.js"></script>
<script src="particle/demo/js/app.js"></script>
<script>

    /* $(document).ready(function() {
      toastr.error("Your account is on hold.");
    }); */

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

    function toggleMenu() {

    if (document.getElementById("wave").style.left == "900px") {
      document.getElementById("wave").style.left = "200px"

    } else {
      document.getElementById("wave").style.left = "900px"
    }
    }
</script>
<script src="scripts/particles-js"></script>
</html>