<?php
  session_start();
  include"../config/connect.php";
  
  $userID = $_SESSION['user_id'];

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
      $email = $_POST['email'] ?? null;
      $transaction_type = $_POST['transaction_type'];
      $status = $_POST['status'];
      $method = $_POST['method'];
      $total_paid = $_POST['total_paid'];
      $date_paid = $_POST['date_paid'];
      
      if (empty($transaction_type) || empty($status) || empty($method) || empty($total_paid) || empty($date_paid)) {
        header("Location: ../pages/user/payment/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $receipt_image = null;
      if (!empty($_FILES['receipt_image']['tmp_name'])) {
        $tmp_name = $_FILES['receipt_image']['tmp_name'];
        $filename = basename($_FILES['receipt_image']['name']);
        $upload_dir = '../public/receipts/';
        $receipt_image = $upload_dir . $filename;

        if (!is_dir($upload_dir)) {
          mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($tmp_name, $receipt_image)) {
          header("Location: ../pages/user/trainer/create.php?message=Failed to upload image.&type=error");
          exit();
        }
      }

      $insert_sql = "INSERT INTO payments 
      (user_id, email, transaction_type, status, method, total_paid, date_paid, receipt_image) 
      VALUES ('$userID', '$email', '$transaction_type', '$status', '$method', '$total_paid', '$date_paid', '$receipt_image')";

      $membership_id = $_POST['membership_id'];
      $payment_status = "paid";

      $update_sql = "UPDATE memberships SET payment_status='$payment_status' WHERE membership_id = $membership_id";

      $insert_result = $conn->query($insert_sql);
      $update_result = $conn->query($update_sql);

      if($insert_result && $update_result){
        header("Location: ../pages/user/membership.php?message=Payment Submitted Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }

    elseif(isset($_POST['update'])){
      $payment_id = $_POST['payment_id'];
      $membership_id = $_POST['membership_id'];
      $status = $_POST['status'];
      $memberStatus = "active";
      $payStatus = "paid";

      $sql = "UPDATE payments SET status='$status' WHERE payment_id = $payment_id";

      $updateSql = "UPDATE memberships SET status='$memberStatus', payment_status='$payStatus' WHERE membership_id = $membership_id";

      $payment = $conn->query($sql);
      $paymentSql = $conn->query($updateSql);

      if($payment && $paymentSql){
        header("Location: ../pages/admin/billing.php?message=Trainer Created Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }

    elseif(isset($_POST['delete'])){
      $payment_id = $_POST['payment_id'];
      $membership_id = $_POST['membership_id'];

      $sql = "DELETE FROM payments WHERE payment_id=$payment_id";

      $deleteSql = "DELETE FROM memberships WHERE membership_id=$membership_id";

      $membershipSql = $conn->query($sql);
      $del = $conn->query($deleteSql);
  
      if($membershipSql && $del){
        header("Location: ../pages/admin/billing.php?message=Trainers Deleted Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }

    if(isset($_POST['renew'])){
      $email = $_POST['email'] ?? null;
      $transaction_type = $_POST['transaction_type'];
      $status = $_POST['status'];
      $method = $_POST['method'];
      $total_paid = $_POST['total_paid'];
      $date_paid = $_POST['date_paid'];
      
      if (empty($transaction_type) || empty($status) || empty($method) || empty($total_paid) || empty($date_paid)) {
        header("Location: ../pages/user/payment/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $receipt_image = null;
      if (!empty($_FILES['receipt_image']['tmp_name'])) {
        $tmp_name = $_FILES['receipt_image']['tmp_name'];
        $filename = basename($_FILES['receipt_image']['name']);
        $upload_dir = '../public/receipts/';
        $receipt_image = $upload_dir . $filename;

        if (!is_dir($upload_dir)) {
          mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($tmp_name, $receipt_image)) {
          header("Location: ../pages/user/trainer/create.php?message=Failed to upload image.&type=error");
          exit();
        }
      }

      $insert_sql = "INSERT INTO payments 
      (user_id, email, transaction_type, status, method, total_paid, date_paid, receipt_image) 
      VALUES ('$userID', '$email', '$transaction_type', '$status', '$method', '$total_paid', '$date_paid', '$receipt_image')";

      $membership_id = $_POST['membership_id'];
      $renew_status = "active";
      $payment_status = "paid";

      $update_sql = "UPDATE memberships SET status=' $renew_status', payment_status='$payment_status' WHERE membership_id = $membership_id";

      $insert_result = $conn->query($insert_sql);
      $update_result = $conn->query($update_sql);

      if($insert_result && $update_result){
        header("Location: ../pages/user/membership.php?message=Payment Submitted Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }
  }
?>