<?php
session_start();
include "../../config/connect.php";

if (!isset($_SESSION['user_id'])) {
    error_log("User not logged in, redirecting to login page");

    header("Location: ../auth/login.php");
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
    <title>PAP's Fitness Gym - Equipments</title>
  </head>

  <body style="background-color: black; position: relative;">
  <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">EQUIPMENTS</p>

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
          onclick="window.location.href='auth/login.php'"
        >
          Home Page
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Profile
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='equipment.php'"
        >
          Equipment
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='membership.php'"
        >
          Membership
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Class Schedule
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Billing History
        </button>
      </div>
    </div>

    <div class="px-52 w-full flex flex-col items-center py-16">
      <div class="max-w-full w-full grid grid-cols-5 gap-8">
        <?php foreach ($equipments as $equipment): ?>
          <div class="w-full bg-[#fabf3b] flex flex-col pb-2">
            <img 
              src="<?php $equipment['image'] ?>" 
              alt="<?php echo $equipment['name'] ?>"
              class="w-full h-24 object-cover"
            />

            <p class="text-base font-semibold indent-6"><?php echo $equipment['name'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </body>
</html>