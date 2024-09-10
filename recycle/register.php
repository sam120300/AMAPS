<head>
  <script src="jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require './connect/config.php';

      $emp_no = $password = $confirmpassword =  "";
      $emp_no_err = $password_err = $confirmpassword_err = "";
      
      // Processing form data when form is submitted
      if($_SERVER["REQUEST_METHOD"] == "POST"){
          // Validate name
          $input_emp_no = trim($_POST["reg_employeeID"]);
          if(empty($input_emp_no)){
              $emp_no_err = "Please enter your employee ID.";     
          } else{
              $emp_no = $input_emp_no;
          }
          
          // Validate firstname
          $input_password = trim($_POST["reg_password"]);
          if(empty($input_password)){
              $password_err = "Please enter your password.";     
          } else{
              $password = $input_password;
          }
          
          // Validate lastname
          $input_confirmpassword = trim($_POST["reg_confirmpassword"]);
          if(empty($input_confirmpassword)){
              $confirmpassword_err = "Please confirm your password";     
          } else{
              $confirmpassword = $input_confirmpassword;
          }
          
          // Check input errors before inserting in database
          if(empty($emp_no_err) && empty($password_err) && empty($confirmpassword_err)){
              // Prepare an insert statement
              $sql = "INSERT INTO users (emp_no, password) VALUES (?, ?)";
              
              if($stmt = mysqli_prepare($conn, $sql)){
                  mysqli_stmt_bind_param($stmt, "ss", $param_emp_no, $param_password);
                  $data = '';
                  // Set parameters
                  $param_emp_no = $emp_no;
                  $param_password = md5($password);
      
                  if(mysqli_stmt_execute($stmt)){
                    echo '<script> alert("registered Kineme"); </script>';
                      header("location: ./admin/index.php");
                      exit();
                  } else{
                      echo "Oops! Something went wrong. Please try again later.";
                  }
              }
      
              mysqli_stmt_close($stmt);
          }
      
      }

?>