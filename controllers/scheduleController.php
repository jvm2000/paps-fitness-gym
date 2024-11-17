<?php
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
      $trainer_id = $_POST['trainer_id'];
      $user_id = $_POST['user_id'];
      $name = $_POST['name'];
      $status = 'pending';

      if (empty($trainer_id) || empty($user_id) || empty($name)) {
        header("Location: ../pages/user/schedule/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $sql = "INSERT INTO schedules (trainer_id, user_id, name, status) VALUES ('$trainer_id', '$user_id', '$name', '$status')";

      if($conn->query($sql)){
        header("Location: ../pages/user/schedule.php?message=Trainer Created Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }

    elseif(isset($_POST['update'])){
      $schedule_id = $_POST['schedule_id'];
      $status = $_POST['status'];

      if (empty($schedule_id) || empty($status)) {
        header("Location: ../pages/admin/schedules.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $sql = "UPDATE schedules SET status='$status' WHERE schedule_id = $schedule_id";

      if($conn->query($sql)){
        header("Location: ../pages/admin/schedules.php?message=Schedule Updated Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }

    elseif(isset($_POST['delete'])){
      $schedule_id = $_POST['schedule_id'];

      $sql = "DELETE FROM schedules WHERE schedule_id=$schedule_id";
  
      if($conn->query($sql)){
        header("Location: ../pages/user/schedule.php?message=Schedule Deleted Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }
  }
?>