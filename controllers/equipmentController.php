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

        if (!is_dir($upload_dir)) {
          mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($tmp_name, $image)) {
          header("Location: ../pages/admin/equipment/create.php?message=Failed to upload image.&type=error");
          exit();
        }
      }

      $sql = "INSERT INTO equipments (name, type, quantity, equipment_condition, last_maintenance, due_maintenance, status, image) VALUES ('$name', '$type', '$quantity', '$equipment_condition', '$last_maintenance', '$due_maintenance', '$status', '$image')";

      if($conn->query($sql)){
        header("Location: ../pages/admin/equipment.php?message=Equipment Created Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['update'])){
      $equipment_id = $_POST['equipment_id'];
      $name = $_POST['name'];
      $type = $_POST['type'];
      $quantity = $_POST['quantity'];
      $equipment_condition = $_POST['equipment_condition'];
      $last_maintenance = $_POST['last_maintenance'];
      $due_maintenance = $_POST['due_maintenance'];
      $status = $_POST['status'];
      $image = $_POST['image'];

      if (empty($name) || empty($type) || empty($quantity) || empty($equipment_condition) || empty($last_maintenance) || empty($due_maintenance) || empty($status)) {
        header("Location: ../pages/admin/equipment/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      if (!empty($_FILES['image']['tmp_name'])) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = basename($_FILES['image']['name']);
        $upload_dir = '../public/equipments/';
        $image = $upload_dir . $filename;

        if (!is_dir($upload_dir)) {
          mkdir($upload_dir, 0777, true);
        }

        if (!move_uploaded_file($tmp_name, $image)) {
          header("Location: ../pages/admin/equipment.php?message=Failed to upload image.&type=error");
          exit();
        }
      }

      $sql = "UPDATE equipments SET name='$name', type='$type', quantity='$quantity', equipment_condition='$equipment_condition', last_maintenance='$last_maintenance', due_maintenance='$due_maintenance', status='$status', image='$image'  WHERE equipment_id = $equipment_id";

      if($conn->query($sql)){
        header("Location: ../pages/admin/equipment.php?message=Package Updated Successfully");
      } else {
        echo "ERROR! Created unsuccessfully";
      }
    }

    elseif(isset($_POST['delete'])){
      $equipment_id = $_POST['equipment_id'];

      $sql = "DELETE FROM equipments WHERE equipment_id=$equipment_id";
  
      if($conn->query($sql)){
        header("Location: ../pages/admin/equipment.php?message=Package Deleted Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }
  }
?>