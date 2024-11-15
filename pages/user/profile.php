<?php
session_start();
include "../../config/connect.php";

if (!isset($_SESSION['user_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/login.php");
  exit();
}

$userID = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = $userID";
$users = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($users);

$firstname = $user['firstname'];
$lastname = $user['lastname'];
$email = $user['email'];
$phone = $user['phone'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Profile</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">USER PROFILE</p>

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
      <div class="max-w-2xl bg-[#fabf3b] w-full px-6 py-5 flex flex-col items-start space-y-10">
        <p class="text-5xl text-black font-bold">Profile</p>

        <div class="grid grid-cols-2 items-center max-w-xs w-full gap-y-6">
          <p class="text-base font-medium">First Name:</p>
          <p class="text-base"><?php echo $firstname ?></p>

          <p class="text-base font-medium">Last Name:</p>
          <p class="text-base"><?php echo $lastname ?></p>

          <p class="text-base font-medium">Email:</p>
          <p class="text-base"><?php echo $email ?></p>

          <p class="text-base font-medium">Phone:</p>
          <p class="text-base"><?php echo $phone ?></p>

          <p class="text-base font-medium">Password:</p>
          <p class="text-base">******</p>
        </div>

        <button 
          class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm"
          onclick="window.location.href='profile/edit.php'"
        >
          Edit
        </button>
      </div>
    </div>
  </body>
</html>