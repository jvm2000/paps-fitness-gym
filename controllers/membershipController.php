<?php
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
      $user_id = $_POST['user_id'];
      $package_id = $_POST['package_id'];
      $type = $_POST['type'];
      $service_type = $_POST['service_type'];
      $start_date = $_POST['start_date'];
      $expiration_date = $_POST['expiration_date'];
      $amount = $_POST['amount'];
      $status = $_POST['status'];
      $payment_status = $_POST['payment_status'];
      $coach = $_POST['coach'] ?? null;
      $created_at = $_POST['created_at'];

      if (empty($user_id) || empty($package_id) || empty($type) || empty($service_type) || empty($start_date) || empty($expiration_date) || empty($amount) || empty($status) || empty($payment_status)) {
        header("Location: ../pages/user/membership.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $sql = "INSERT INTO memberships (user_id, package_id, type, service_type, start_date, expiration_date, amount, status, payment_status, coach, created_at) 
              VALUES ('$user_id', '$package_id', '$type', '$service_type', '$start_date', '$expiration_date', '$amount', '$status', '$payment_status', '$coach', '$created_at')";

      if($conn->query($sql)){
        header("Location: ../pages/user/membership.php?message=Membership Submitted Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['update'])){
      $membership_id = $_POST['membership_id'];
      $status = $_POST['status'];
      $payment_status = $_POST['payment_status'];

      $sql = "UPDATE memberships SET status='$status', payment_status='$payment_status' WHERE membership_id = $membership_id";

      if($conn->query($sql)){
        header("Location: ../pages/admin/membership.php?message=Membership Updated Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['delete'])){
      $membership_id = $_POST['membership_id'];

      $sql = "DELETE FROM memberships WHERE membership_id=$membership_id";
  
      if($conn->query($sql)){
        header("Location: ../pages/admin/membership.php?message=Membership Deleted Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['cancel'])){
      $membership_id = $_POST['membership_id'];

      $sql = "DELETE FROM memberships WHERE membership_id=$membership_id";
  
      if($conn->query($sql)){
        header("Location: ../pages/user/membership.php?message=Membership Cancelled Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }
  }
?>