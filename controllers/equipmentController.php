<?php
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
      $name = $_POST['name'];
      $type = $_POST['type'];
      $quantity = $_POST['quantity'];
      $equipment_condition = $_POST['equipment_condition'];
      $last_maintenance = $_POST['last_maintenance'];
      $due_maintenance = $_POST['due_maintenance'];
      $status = $_POST['status'];

      if (empty($name) || empty($type) || empty($quantity) || empty($equipment_condition) || empty($last_maintenance) || empty($due_maintenance) || empty($status)) {
        header("Location: ../pages/admin/equipment/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $image = null;
      if (!empty($_FILES['image']['tmp_name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = basename($_FILES['image']['name']);
        $upload_dir = '../public/equipments/'; 
        $image = $upload_dir . $filename;
      }

      $sql = "INSERT INTO equipments (name, type, quantity, equipment_condition, last_maintenance, due_maintenance, status, image) VALUES ('$name', '$type', '$quantity', '$equipment_condition', '$last_maintenance', '$due_maintenance', '$status', '$image')";

      if($conn->query($sql)){
        header("Location: ../pages/admin/equipment.php?message=Equipment Created Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['update'])){
      $package_id = $_POST['package_id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      $daily_rate = isset($_POST['daily_rate']) && $_POST['daily_rate'] !== '' ? $_POST['daily_rate'] : null;
      $monthly_rate = isset($_POST['monthly_rate']) && $_POST['monthly_rate'] !== '' ? $_POST['monthly_rate'] : null;
      $hourly_rate = isset($_POST['hourly_rate']) && $_POST['hourly_rate'] !== '' ? $_POST['hourly_rate'] : null;

      $sql = "UPDATE packages SET name='$name', description='$description', daily_rate='$daily_rate', monthly_rate='$monthly_rate', hourly_rate='$hourly_rate' WHERE package_id = $package_id";

      if($conn->query($sql)){
        header("Location: ../pages/admin/package.php?message=Package Updated Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['delete'])){
      $package_id = $_POST['package_id'];

      $sql = "DELETE FROM packages WHERE package_id=$package_id";
  
      if($conn->query($sql)){
        header("Location: ../pages/admin/package.php?message=Package Deleted Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }
  }
?>