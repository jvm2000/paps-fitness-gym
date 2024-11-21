<?php
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
      $membership_id = $_POST['membership_id'];
      $method = $_POST['method'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $address = $_POST['address'];
      $age = $_POST['age'];
      $type = $_POST['type'];
      $service_type = $_POST['service_type'];
      $start_date = $_POST['start_date'];
      $expiration_date = $_POST['expiration_date'];
      $amount = $_POST['amount'];
      $status = $_POST['status'];
      $payment_status = $_POST['payment_status'];
      $coach = $_POST['coach'] ?? null;
      $created_at = $_POST['created_at'];

      $sql = "INSERT INTO memberships (membership_id, name, email, contact, address, age, type, service_type, start_date, expiration_date, amount, status, payment_status, coach, created_at) 
              VALUES ('$membership_id' ,'$name', '$email', '$contact', '$address', '$age', '$type', '$service_type', '$start_date', '$expiration_date', '$amount', '$status', '$payment_status', '$coach', '$created_at')";

      $insert_sql = "INSERT INTO payments (membership_id, name, transaction_type, status, method, total_paid, date_paid, payment_due)
                    VALUES ('$membership_id', '$name', '$type', '$payment_status', '$method', '$amount', '$created_at', '$expiration_date')";

      $membershipSql = $conn->query($sql);
      $paymentSql = $conn->query($insert_sql);

      if($membershipSql && $paymentSql){
        header("Location: ../pages/admin/membership.php?message=Membership Submitted Successfully");
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