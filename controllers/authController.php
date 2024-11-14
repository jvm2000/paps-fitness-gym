<?php
  session_start();
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Admin Login
    if(isset($_POST['admin-login'])){
      $username = $_POST['username'];
      $password = $_POST['password'];

      if (empty($username) || empty($password)) {
          header("Location: admin-login.php?message=Please fill in all fields.&type=error");
          exit();
      }

      // Prepare and execute the SQL query
      $stmt = $conn->prepare("SELECT admin_id, username, password FROM admin WHERE username = ?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
          $stmt->bind_result($id, $username, $stored_password);
          $stmt->fetch();

          if ($password === $stored_password) {
              $_SESSION['admin_id'] = $id;
              $_SESSION['username'] = $username;
              header("Location: ../pages/admin/home.php");
              exit();
          } else {
              header("Location: ../pages/auth/admin-login.php?message=Invalid password.&type=error");
              exit();
          }
      } else {
          header("Location: ../pages/auth/admin-login.php?message=User not found.&type=error");
          exit();
      }
    }

    if(isset($_POST['user-login'])){
      $email = $_POST['email'];
      $password = $_POST['password'];

      if (empty($email) || empty($password)) {
          header("Location: login.php?message=Please fill in all fields.&type=error");
          exit();
      }

      $stmt = $conn->prepare("SELECT user_id, email, password FROM users WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->store_result();

      if ($stmt->num_rows > 0) {
          $stmt->bind_result($id, $email, $stored_password);
          $stmt->fetch();

          if ($password === $stored_password) {
              $_SESSION['user_id'] = $id;
              $_SESSION['email'] = $email;
              header("Location: ../pages/user/home.php");
              exit();
          } else {
              header("Location: ../pages/auth/login.php?message=Invalid password.&type=error");
              exit();
          }
      } else {
          header("Location: ../pages/auth/login.php?message=User not found.&type=error");
          exit();
      }
    }

    //User Register
    elseif(isset($_POST['user-register'])){
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $phone = $_POST['phone'];

      if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($phone)) {
          header("Location: login.php?message=Please fill in all fields.&type=error");
          exit();
      }

      $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

      $sql = "INSERT INTO users (firstname, lastname, email, password, phone) VALUES ('$firstname', '$lastname', '$email', '$hashedPassword', '$phone')";

      if($conn->query($sql)){
        header("Location: ../pages/auth/login.php?message=User Registered Successfully");
      } else{
        header("Location: ../pages/auth/register.php?message=ERROR: User cannot be registered");
      }
    }

    elseif(isset($_POST['update'])){
      $evCode = $_POST['evCode'];
      $cvName = $_POST['cvName'];
      $cvDate = $_POST['cvDate'];
      $cvVenue = $_POST['cvVenue'];
      $evRFee = $_POST['evRFee'];

      $sql = "UPDATE events SET cvName='$cvName', cvDate='$cvDate', cvVenue='$cvVenue', evRFee='$evRFee' WHERE evCode = $evCode";

      if($conn->query($sql)){
        Header("Location:../pages/events_management.php");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['delete'])){
      $evCode = $_POST['evCode'];

      $sql = "DELETE FROM events WHERE evCode=$evCode";
  
      if($conn->query($sql)){
        Header("Location:../pages/events_management.php");
      }
      echo "ERROR! Created unsuccessfully";
    }
  }
?>