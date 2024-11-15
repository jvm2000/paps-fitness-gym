<?php
session_start();
include "../../../config/connect.php";

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
    <title>PAP's Fitness Gym - Edit Profile</title>
  </head>

  <body style="background-color: black; position: relative;">
  <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../../public/images/logo.png" alt="Logo" class="w-full h-auto">
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
          onclick="window.location.href='auth/login.php'"
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
      <form 
        action="../../../controllers/authController.php" 
        method="POST"
        class="max-w-2xl bg-[#fabf3b] w-full px-6 py-5 flex flex-col items-start space-y-10"
      >
        <input type="hidden" name="user_id" value="<?php echo $userID ?>">

        <p class="text-5xl text-black font-bold">Edit Profile</p>

        <div class="flex flex-col items-start max-w-full w-full space-y-6">
          <div class="space-y-1.5 w-full">
            <p class="text-base font-medium">First Name:</p>
            <input 
              name="firstname"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black"
              placeholder="First Name"
              value="<?php echo $firstname ?>"
            />
          </div>

          <div class="space-y-1.5 w-full">
            <p class="text-base font-medium">Last Name:</p>
            <input 
              name="lastname"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black"
              placeholder="Last Name"
              value="<?php echo $lastname ?>"
            />
          </div>

          <div class="space-y-1.5 w-full">
            <p class="text-base font-medium">Email:</p>
            <input 
              type="email"
              name="email"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black"
              placeholder="Email"
              value="<?php echo $email ?>"
            />
          </div>

          <div class="space-y-1.5 w-full">
            <p class="text-base font-medium">Phone:</p>
            <input 
              name="phone"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black"
              placeholder="Phone"
              value="<?php echo $phone ?>"
            />
          </div>
        </div>

        <div class="flex items-center space-x-4">
          <div 
            class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm cursor-pointer"
            onclick="window.location.href='../profile.php'"
          >
            Back
          </div>

          <button 
            class="bg-black text-yellow-300 px-5 py-1.5 text-black font-medium rounded-sm"
            name="update"
            type="submit"
          >
            Update
          </button>
        </div>
      </form>
    </div>
  </body>
</html>