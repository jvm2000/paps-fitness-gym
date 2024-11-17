<?php
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
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

      $image = null;
      if (!empty($_FILES['image']['tmp_name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = basename($_FILES['image']['name']);
        $upload_dir = '../public/trainers/';
        $image = $upload_dir . $filename;

        if (!is_dir($upload_dir)) {
          mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($tmp_name, $image)) {
          header("Location: ../pages/admin/trainer/create.php?message=Failed to upload image.&type=error");
          exit();
        }
      }

      $sql = "INSERT INTO trainers (name, specialty, experience, hourly_rate, day_from, day_to, time_from, time_to, image) VALUES ('$name', '$specialty', '$experience', '$hourly_rate', '$day_from', '$day_to', '$time_from', '$time_to', '$image')";

      if($conn->query($sql)){
        header("Location: ../pages/admin/trainers.php?message=Trainer Created Successfully");
      }
      echo "ERROR! Created unsuccessfully";
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
      $trainer_id = $_POST['trainer_id'];

      $sql = "DELETE FROM trainers WHERE trainer_id = $trainer_id";
  
      if($conn->query($sql)){
        header("Location: ../pages/admin/trainers.php?message=Trainers Deleted Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }
  }
?>