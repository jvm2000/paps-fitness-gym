<?php
include "../../config/connect.php";

$title = "Profile";
$pageHeader = "Profile";
$childView = __DIR__ . '/profile.php';

include('../../layouts/user.php');

$userID = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE user_id = $userID";
$users = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($users);

$firstname = $user['firstname'];
$lastname = $user['lastname'];
$email = $user['email'];
$phone = $user['phone'];
$gender = $user['gender'];
?>

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

      <p class="text-base font-medium">Gender:</p>
      <p class="text-base"><?php echo $gender ?></p>

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