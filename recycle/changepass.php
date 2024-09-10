<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require './connect/config.php';

if (isset($_POST['submit'])) {

    $emp_no = $_GET['id'];
    $npass = $_POST['newpass'];
    $cpass = $_POST['confirmpassword'];

    if ($npass != $cpass) {
      print "Passwords don't match. Click <a href=\"new_password_form.php\">here</a> to try again.<br/>";
    }

    $hashedpass = md5($npass);
    
    $sql = "SELECT * from users where emp_no = '$emp_no'";
    $result = mysqli_query($conn, $sql);
    while($rows = $result->fetch_assoc()){
        $setpass = "UPDATE users SET password = ? WHERE emp_no = '$emp_no'";

        if ($stmt = mysqli_prepare($conn, $setpass)) {
          mysqli_stmt_bind_param($stmt, "s", $param_pass);

          $param_pass = $hashedpass;

          if (mysqli_stmt_execute($stmt)) {
                echo '<script>
                        alert("Password Changed Successfully!");
                        window.location = "index.php"
                    </script>';
          } else {
              echo "Oops! Something went wrong. Please try again later.";
          }
      }
      mysqli_stmt_close($stmt);
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
.container{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 500px;
    height: 280px;
    background-color: #497384;
    border-radius: 15px;
}
button {
  padding: 17px 40px;
  border-radius: 50px;
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
<body>
    <div id="particles-js"></div>
    <?php if (!isset($_POST['next'])) {?>
    <div class="container">
        
        <form action="changepass.php?id=<?php echo $_GET['id']; ?>" method="POST" class="form" autocomplete="off">
                    <div class="title mt-2">
                        <p class="h4 text-center p-2 text-light">Change Password</p>
                    </div>
                    <div class="p-3">
                    <div class="EmployeeID col mb-2">
                        <input type="password" name="newpass" id="newpass" placeholder="New Password" class="form-control mb-3" required>
                        <input type="password" name="confirmpass" id=confirmpass" placeholder="Confirm New Password" class="form-control mb-3" required>
                    </div>
                    <div class="r-pass row text-center">
                        <div class="mb-2">
                            <button class="w-75 h-100 loginbtn" type="submit" name="submit">Submit <i class="fa-solid fa-arrow-right"></i></button>
                        </div>
                    </div>

                    </div>
                </form>
                <?php } ?>
        </div>

</body>
<script src="particle/particles.js"></script>
<script src="particle/demo/js/app.js"></script>
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