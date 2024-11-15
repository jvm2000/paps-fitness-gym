<?php
session_start();
include "../../config/connect.php";

if (!isset($_SESSION['admin_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/admin-login.php");
  exit();
}

$sql = "SELECT * FROM equipments";

$result = mysqli_query($conn, $sql);

$equipments = [];

if ($result->num_rows > 0) {
  while ($equipment = $result->fetch_assoc()) {
    $equipments[] = $equipment; 
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Manage Equipment</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">MANAGE EQUIPMENT</p>

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
          onclick="window.location.href='membership.php'"
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
      <div class="max-w-full w-full flex flex-col space-y-8 items-start">
        <div class="flex justify-end w-full">
          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='equipment/create.php'"
          >
            Add Equipment
          </button>
        </div>

        <div class="w-full rounded-md bg-[#fabf3b]">
          <table class="w-full table-auto">
            <thead>
              <tr>
                <th class="py-4 border-b border-r border-black">Equipment ID</th>
                <th class="py-4 border-b border-r border-black">Image</th>
                <th class="py-4 border-b border-r border-black">Name</th>
                <th class="py-4 border-b border-r border-black">Type</th>
                <th class="py-4 border-b border-r border-black">Quantity</th>
                <th class="py-4 border-b border-r border-black">Condition</th>
                <th class="py-4 border-b border-r border-black">Last Maintenance</th>
                <th class="py-4 border-b border-r border-black">Next Maintenance Due</th>
                <th class="py-4 border-b border-r border-black">Status</th>
                <th class="py-4 border-b border-black">Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($equipments as $equipment): ?>
                <tr>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['equipment_id'] ?></td>
                  <td class="text-base text-left text-black indent-4 border-b border-r border-black">
                    <img src="<?php echo '../' . $equipment['image']; ?>" alt="" class="w-full h-24 object-cover">
                  </td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['name'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['type'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['quantity'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['equipment_condition'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['last_maintenance'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['due_maintenance'] ?></td>
                  <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $equipment['status'] ?></td>
                  <td class="py-4 text-base text-center border-b border-black">
                    <p>
                      <a href="membership/edit.php?membership_id=<?php echo $membership['membership_id']?>">Edit</a> 
                      <span>-</span>

                      <form action='../../controllers/equipmentController.php' method='POST'>
                        <input type="hidden" name="equipment_id" value="<?php echo $equipment['equipment_id']?>">
                        <button type="submit" name="delete">Delete</button> 
                      </form>
                    </p>
                  </td>
                </tr>
              <?php endforeach;  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>