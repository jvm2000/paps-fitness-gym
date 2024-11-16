<?php
include "../../../config/connect.php";

$title = "Profile Edit";
$pageHeader = "Profile Edit";
$childView = __DIR__ . '/edit.php';
$noHeader = true;

include('../../../layouts/user.php');

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

<div class="px-52 w-full flex flex-col items-center">
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

      <div class="space-y-1.5 w-full">
        <p class="text-base font-medium">Gender:</p>
        <select 
          name="gender" 
          class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-[#fabf3b] text-black"
        >
          <option value="male" <?php echo $gender === 'male' ? 'selected' : ''; ?>>Male</option>
          <option value="female" <?php echo $gender === 'female' ? 'selected' : ''; ?>>Female</option>
        </select>
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