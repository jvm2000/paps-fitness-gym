<?php
include "../../config/connect.php";

$title = 'Home';
$pageHeader = 'Home';
$childView = __DIR__ . '/home.php';

include('../../layouts/user.php');

$userID = $_SESSION['user_id'];

$membershipCount = 0;
$sql = "SELECT COUNT(*) AS total FROM memberships WHERE user_id = $userID";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $membershipCount = $row['total'];
}

$sql = "SELECT * FROM users WHERE user_id = $userID";
$users = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($users);

$firstname = $user['firstname'];
$lastname = $user['lastname'];
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <?php if($membershipCount < 1): ?>
    <div class="max-w-lg w-full rounded-lg bg-[#fabf3b] flex flex-col items-start px-6 py-4 space-y-8">
      <p class="text-4xl font-semibold">Notice</p>

      <div class="p-4 bg-black rounded-lg">
        <p class="text-base text-white">
          Welcome <span class="capitalize font-bold"><?php echo $firstname . ' ' . $lastname ?></span>, while you're free to explore, we highly recommend joining our membership to unlock exclusive features and get the most out of your experience.
        </p>
      </div>

      <button 
        class="bg-black px-5 py-4 text-xl text-white w-full font-medium rounded-lg"
        onclick="window.location.href='membership.php'"
      >
        Click Me!
      </button>
    </div>
  <?php endif; ?>

  <?php if($membershipCount > 0): ?>
    <div class="max-w-lg w-full rounded-lg bg-[#fabf3b] flex flex-col items-start px-6 py-4 space-y-8">
      <p class="text-4xl font-semibold">Welcome</p>

      <div class="p-4 bg-black rounded-lg">
        <p class="text-base text-white">
          You are now currently applied under a membership, enjoy!
        </p>
      </div>
    </div>
  <?php endif; ?>
</div>