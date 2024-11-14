<?php
session_start();
include "../../config/connect.php";

if (!isset($_SESSION['admin_id'])) {
  error_log("User not logged in, redirecting to login page");

  header("Location: ../auth/admin-login.php");
  exit();
}

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
    <title>PAP's Fitness Gym - Manage Packages</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">MANAGE PACKAGES</p>

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
          Membership Management
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
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
          onclick="window.location.href='auth/login.php'"
        >
          Manage Pricing
        </button>

        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm w-full"
          onclick="window.location.href='auth/login.php'"
        >
          Manage Billing
        </button>
      </div>
    </div>

    <div class="px-52 w-full flex flex-col items-center py-16">
      <div class="max-w-4xl w-full flex flex-col space-y-8 items-start">
        <div class="flex justify-end w-full">
          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='package/create.php'"
          >
            Add Package
          </button>
        </div>
        
        <div class="w-full rounded-md bg-[#fabf3b]">
          <table class="w-full table-auto">
            <thead>
              <tr>
                <th class="py-4">Name</th>
                <th>Description</th>
                <th>Daily Price</th>
                <th>Monthly Price</th>
                <th>Hourly Rate</th>
                <th>Actions</th>
              </tr>
            </thead>

            <tbody>
              <?php foreach ($packages as $package): ?>
                <tr>
                  <td class="py-4 text-base text-left text-black indent-4"><?php echo $package['name'] ?></td>
                  <td class="py-4 text-base text-center"><?php echo $package['description'] ?></td>
                  <td class="py-4 text-base text-center"><?php echo !empty($package['daily_rate']) ? $package['daily_rate'] : 'N/A' ?></td>
                  <td class="py-4 text-base text-center"><?php echo !empty($package['monthly_rate']) ? $package['monthly_rate'] : 'N/A' ?></td>
                  <td class="py-4 text-base text-center"><?php echo !empty($package['hourly_rate']) ? $package['hourly_rate'] : 'N/A' ?></td>
                  <td class="py-4 text-base text-center">
                    <p>
                      <a href="package/edit.php?package_id=<?php echo $package['package_id']?>">Edit</a> 
                      <span>-</span>

                      <form action='../../controllers/packageController.php' method='POST'>
                        <input type="hidden" name="package_id" value="<?php echo $package['package_id']?>">
                        <button type="submit" name="delete">Delete</button> 
                      </form>
                    </p>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>