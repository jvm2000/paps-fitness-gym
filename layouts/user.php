<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/login.php");
  exit();
}

$noHeader = isset($noHeader) ? $noHeader : false; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - <?php echo $title; ?></title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/paps-fitness-gym/public/images/logo.png'; ?>" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b] uppercase">User - <?php echo $pageHeader; ?></p>

      <div class="relative">
        <img 
          src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/paps-fitness-gym/public/images/user.png'; ?>" 
          class="w-14 h-auto object-cover border-2 border-white rounded-full cursor-pointer"
          id="userImage"
        />

        <div
          id="dropdownMenu"
          style="display: none;"
          class="absolute z-[9999] top-16 right-0 w-64 bg-[#fabf3b] rounded-lg py-2 px-4"
        >
          <button 
            class="bg-inherit text-black font-medium rounded-sm w-full hover:bg-[#e6ae36] text-left py-2 px-4"
            onclick="window.location.href='../../pages/user/profile.php'"
          >
            View Profile
          </button>

          <button 
            class="bg-inherit text-black font-medium rounded-sm w-full hover:bg-[#e6ae36] text-left py-2 px-4"
            onclick="window.location.href='../../controllers/logoutController.php'"
          >
            Logout
          </button>
        </div>
      </div>
    </header>

    <?php if(!$noHeader): ?>
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
            onclick="window.location.href='profile.php'"
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
            onclick="window.location.href='schedule.php'"
          >
            Class Schedule
          </button>

          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
            onclick="window.location.href='billing.php'"
          >
            Billing History
          </button>
        </div>
      </div>
    <?php endif; ?>

    <?php include_once($childView); ?>
  </body>
</html>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const userImage = document.getElementById('userImage');
    const dropdownMenu = document.getElementById('dropdownMenu');

    userImage.addEventListener('click', () => {
      const isHidden = dropdownMenu.style.display === 'none';
      dropdownMenu.style.display = isHidden ? 'block' : 'none';
    });

    document.addEventListener('click', (event) => {
      if (!userImage.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.style.display = 'none';
      }
    });
  });
</script>