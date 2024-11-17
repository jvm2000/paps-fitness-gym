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
      $trainer_id = $_POST['trainer_id'];
      $name = $_POST['name'];
      $specialty = $_POST['specialty'];
      $experience = $_POST['experience'];
      $hourly_rate = $_POST['hourly_rate'];
      $day_from = $_POST['day_from'];
      $day_to = $_POST['day_to'];
      $time_from = $_POST['time_from'];
      $time_to = $_POST['time_to'];

      if (empty($name) || empty($specialty) || empty($experience) || empty($hourly_rate) || empty($day_from) || empty($day_to) || empty($time_from) || empty($time_to)) {
        header("Location: ../pages/admin/trainer/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $sql = "UPDATE trainers SET name='$name', specialty='$specialty', experience='$experience', hourly_rate='$hourly_rate', day_from='$day_from', day_to='$day_to', time_from='$time_from', time_to='$time_to'  WHERE trainer_id = $trainer_id";

      if($conn->query($sql)){
        header("Location: ../pages/admin/trainers.php?message=Trainer Created Successfully");
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