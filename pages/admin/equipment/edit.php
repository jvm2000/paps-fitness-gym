<?php
session_start();
include "../../../config/connect.php";

if (!isset($_SESSION['admin_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/admin-login.php");
  exit();
}

$equipment_id = $_GET['equipment_id'];

$sql = "SELECT * FROM equipments WHERE equipment_id = $equipment_id";
$equipments = mysqli_query($conn,$sql);
$equipment = mysqli_fetch_assoc($equipments);

$name = $equipment['name'];
$type = $equipment['type'];
$quantity = $equipment['quantity'];
$equipment_condition = $equipment['equipment_condition'];
$last_maintenance = date('Y-m-d', strtotime($equipment['last_maintenance']));
$due_maintenance = date('Y-m-d', strtotime($equipment['due_maintenance']));
$status = $equipment['status'];
$image = $equipment['image'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Add Equipment</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">ADD EQUIPMENT</p>

      <button 
        class="bg-[#fabf3b] px-5 py-1.5 text-black font-medium rounded-sm"
        onclick="window.location.href='../../controllers/logoutController.php'"
      >
        Logout
      </button>
    </header>

    <div class="px-52 w-full">
      <div class="grid grid-cols-6 gap-x-10">
        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='home.php'"
        >
          Home Page
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Membership Management
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='equipment.php'"
        >
          Manage Equipment
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='package.php'"
        >
          Manage Packages
        </button>
        
        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Manage Pricing
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Manage Billing
        </button>
      </div>
    </div>

    <div class="px-52 w-full flex flex-col items-center py-16">
      <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
        <div class="flex justify-end w-full">
          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='../equipment.php'"
          >
            Back
          </button>
        </div>

        <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
          <p class="text-3xl text-black font-bold">Equipment</p>

          <form action="../../../controllers/equipmentController.php" method="POST" class="space-y-6 flex flex-col w-full" enctype="multipart/form-data">
            <input type="hidden" name="equipment_id" value="<?php echo $equipment_id ?>" />

            <input 
              name="name"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Equipment Name"
              value="<?php echo $name ?>"
            />

            <input 
              name="type"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Type"
              value="<?php echo $type ?>"
            />

            <input 
              type="number"
              name="quantity"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Quantity"
              value="<?php echo $quantity ?>"
            />

            <select 
              name="equipment_condition"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
            >
              <option value="poor" <?php echo $equipment_condition === 'poor' ? 'selected' : ''; ?>>Poor</option>
              <option value="good" <?php echo $equipment_condition === 'poor' ? 'selected' : ''; ?>>Good</option>
              <option value="fair" <?php echo $equipment_condition === 'poor' ? 'selected' : ''; ?>>Fair</option>
              <option value="excellent" <?php echo $equipment_condition === 'poor' ? 'selected' : ''; ?>>Excellent</option>
            </select>

            <div class="relative flex items-center">
              <input 
                type="date"
                name="last_maintenance"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-20 rounded-md bg-black text-white"
                value="<?php echo $last_maintenance ?>"
              />
              <p class="absolute left-4 text-white">Last Maintenance:</p>
            </div>

            <div class="relative flex items-center">
              <input 
                type="date"
                name="due_maintenance"
                class="w-full px-4 py-2.5 ring-[1px] ring-black text-base indent-20 rounded-md text-black bg-black text-white"
                value="<?php echo $due_maintenance ?>"
              />
              <p class="absolute left-4 text-white">Due Maintenance</p>
            </div>

            <select 
              name="status"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
            >
              <option value="active" <?php echo $equipment_condition === 'active' ? 'selected' : ''; ?>>Active</option>
              <option value="maintenance" <?php echo $equipment_condition === 'maintenance' ? 'selected' : ''; ?>>Maintenance</option>
            </select>

            <div 
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white min-h-24 max-h-full flex items-center justify-center" 
            >
              <p>Image</p>
              <img 
                src="<?php echo '../../' . $image; ?>"
                alt="Image Preview" class="w-full object-cover h-64" />
            </div>

            <button 
              class="bg-black px-5 py-3 text-black text-base font-medium rounded-lg w-full text-white"
              name="update"
            >
              Update
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>