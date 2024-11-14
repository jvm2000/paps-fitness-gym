<?php
session_start();
include "../../config/connect.php";

if (!isset($_SESSION['user_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/login.php");
  exit();
}

$userID = $_SESSION['user_id'];

$sql = "SELECT * FROM packages";

$result = mysqli_query($conn, $sql);

$packages = [];

if ($result->num_rows > 0) {
  while ($package = $result->fetch_assoc()) {
    $packages[] = $package; 
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Home</title>
  </head>

  <body style="background-color: black; position: relative;">
  <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">USER MEMBERSHIP</p>

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
          onclick="window.location.href='auth/login.php'"
        >
          Profile
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
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

    <div class="w-full flex flex-col items-center py-24 space-y-12">
      <p class="text-3xl font-bold text-[#fabf3b]">Join Paps Fitness Gym!</p>

      <p class="text-3xl font-bold text-[#fabf3b]">Affordable Membership</p>

      <div class="max-w-3xl w-full grid grid-cols-2 gap-x-12">
        <?php foreach ($packages as $package): ?>
          <div class="bg-[#fabf3b] w-full px-4 flex flex-col items-center pt-6 pb-3 space-y-6">
            <p class="text-3xl font-bold"><?php echo $package['name'] ?></p>

            <p class="text-base font-medium text-center px-6 h-7">
              <?php echo $package['description'] ?>
            </p>

            <form action="../../controllers/membershipController.php" method="POST" class="space-y-6 flex flex-col items-center px-4">
              <input type="hidden" name="user_id" value="<?php echo $userID ?>">
              <input type="hidden" name="package_id" value="<?php echo $package['package_id'] ?>">
              <?php
                $membershipType = '';
                if (!empty($package['daily_rate'])) {
                    $membershipType = 'daily';
                } elseif (!empty($package['monthly_rate'])) {
                    $membershipType = 'monthly';
                } elseif (!empty($package['hourly_rate'])) {
                    $membershipType = 'hourly';
                }
              ?>
              <input type="hidden" name="type" value="<?php echo $membershipType; ?>">
              <input type="hidden" name="status" value="inactive">
              <input type="hidden" name="payment_status" value="pending">

              <div class="flex items-center space-x-4">
                <div class="space-y-1.5">
                  <label for="start-date" class="text-xs">Start Date</label>

                  <input 
                    id="start-date"
                    type="date"
                    name="start_date"
                    class="w-full px-4 py-2.5 ring-[1px] ring-black text-xs rounded-md text-black bg-[#fabf3b]"
                  />
                </div>

                <div class="space-y-1.5">
                  <label for="expiration_date" class="text-xs">Expiration Date</label>

                  <input 
                    id="expiration_date"
                    type="date"
                    name="expiration_date"
                    class="w-full px-4 py-2.5 ring-[1px] ring-black text-xs rounded-md text-black bg-[#fabf3b]"
                  />
                </div>
              </div>

              <button 
                class="text-yellow-300 bg-black px-10 py-1.5 text-black text-sm font-medium rounded-sm"
                name="create"
                type="submit"
              >
                Join Now
              </button>
            </form>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </body>
</html>