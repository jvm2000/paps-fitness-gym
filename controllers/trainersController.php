<?php
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
      $name = $_POST['name'];
      $age = $_POST['age'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $contact = $_POST['contact'];
      $specialty = $_POST['specialty'];

      if (empty($name) || empty($age) || empty($gender) || empty($address) || empty($contact) || empty($specialty)) {
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

      $sql = "INSERT INTO trainers (name, age, gender, address, contact, specialty) VALUES ('$name', '$age', '$gender', '$address', '$contact', '$specialty')";

      if($conn->query($sql)){
        header("Location: ../pages/admin/trainers.php?message=Trainer Created Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['update'])){
      $trainer_id = $_POST['trainer_id'];
      $name = $_POST['name'];
      $age = $_POST['age'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $contact = $_POST['contact'];
      $specialty = $_POST['specialty'];

      if (empty($name) || empty($age) || empty($gender) || empty($address) || empty($contact) || empty($specialty)) {
        header("Location: ../pages/admin/trainer/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $sql = "UPDATE trainers SET name='$name', age='$age', gender='$gender', address='$address', contact='$contact', specialty='$specialty'  WHERE trainer_id = $trainer_id";

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