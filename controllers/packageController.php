<?php
  include"../config/connect.php";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    //Create
    if(isset($_POST['create'])){
      $name = $_POST['name'];
      $description = $_POST['description'];
      $daily_rate = isset($_POST['daily_rate']) && $_POST['daily_rate'] !== '' ? $_POST['daily_rate'] : null;
      $monthly_rate = isset($_POST['monthly_rate']) && $_POST['monthly_rate'] !== '' ? $_POST['monthly_rate'] : null;
      $weekly_rate = isset($_POST['weekly_rate']) && $_POST['weekly_rate'] !== '' ? $_POST['weekly_rate'] : null;
      $yearly_rate = isset($_POST['yearly_rate']) && $_POST['yearly_rate'] !== '' ? $_POST['yearly_rate'] : null;

      if (empty($name) || empty($description)) {
        header("Location: ../pages/admin/package/create.php?message=Please fill in all fields.&type=error");
        exit();
      }

      $sql = "INSERT INTO packages (name, description, daily_rate, monthly_rate, weekly_rate, yearly_rate) 
              VALUES 
              ('$name', '$description', '$daily_rate', '$monthly_rate', '$weekly_rate', '$yearly_rate')";

      if($conn->query($sql)){
        header("Location: ../pages/admin/package.php?message=Package Created Successfully");
      }
      echo "ERROR! Created unsuccessfully";
    }

    elseif(isset($_POST['update'])){
      $package_id = $_POST['package_id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      $daily_rate = isset($_POST['daily_rate']) && $_POST['daily_rate'] !== '' ? $_POST['daily_rate'] : null;
      $monthly_rate = isset($_POST['monthly_rate']) && $_POST['monthly_rate'] !== '' ? $_POST['monthly_rate'] : null;
      $weekly_rate = isset($_POST['weekly_rate']) && $_POST['weekly_rate'] !== '' ? $_POST['weekly_rate'] : null;
      $yearly_rate = isset($_POST['yearly_rate']) && $_POST['yearly_rate'] !== '' ? $_POST['yearly_rate'] : null;

      $sql = "UPDATE packages SET 
              name='$name', description='$description', daily_rate='$daily_rate', monthly_rate='$monthly_rate', weekly_rate='$weekly_rate', yearly_rate='$yearly_rate'  
              WHERE package_id = $package_id";

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