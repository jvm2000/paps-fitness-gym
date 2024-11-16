<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    error_log("User not logged in, redirecting to login page");

    header("Location: ../auth/admin-login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Add Packages</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">ADD PACKAGES</p>

      <button 
        class="bg-[#fabf3b] px-5 py-1.5 text-black font-medium rounded-sm"
        onclick="window.location.href='../../controllers/logoutController.php'"
      >
        Logout
      </button>
    </header>

    <div class="px-52 w-full flex flex-col items-center py-16">
      <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
        <div class="flex justify-end w-full">
          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='../package.php'"
          >
            Back
          </button>
        </div>

        <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
          <p class="text-3xl text-black font-bold">Package</p>

          <form action="../../../controllers/packageController.php" method="POST" class="space-y-6 flex flex-col w-full">
            <input 
              name="name"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Package Name"
            />

            <textarea 
              name="description"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Description"
            ></textarea>

            <input 
              name="daily_rate"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Daily Rate"
            />

            <input 
              name="monthly_rate"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Monthly Rate"
            />

            <input 
              name="weekly_rate"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Weekly Rate"
            />

            <input 
              name="yearly_rate"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Yearly Rate"
            />

            <button 
              class="bg-black px-5 py-3 text-black text-base font-medium rounded-lg w-full text-white"
              name="create"
            >
              Create
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>