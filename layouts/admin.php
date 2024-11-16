<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/admin-login.php");
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
    <title>Admin - <?php echo $title; ?></title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/paps-fitness-gym/public/images/logo.png'; ?>" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b] uppercase">Admin - <?php echo $pageHeader; ?></p>

      <button 
        class="bg-[#fabf3b] px-5 py-1.5 text-black font-medium rounded-sm"
        onclick="window.location.href='../../controllers/logoutController.php'"
      >
        Logout
      </button>
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
            onclick="window.location.href='trainers.php'"
          >
            Manage Trainers
          </button>

          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
            onclick="window.location.href='billing.php'"
          >
            Manage Billing
          </button>
        </div>
      </div>
    <?php endif; ?>

    <?php include_once($childView); ?>
  </body>
</html>