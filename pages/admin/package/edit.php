<?php
  session_start();
  include "../../../config/connect.php";

  if (!isset($_SESSION['admin_id'])) {
    error_log("User not logged in, redirecting to login page");

    header("Location: ../auth/admin-login.php");
    exit();
  }

  $package_id = $_GET['package_id'];

  $sql = "SELECT * FROM packages WHERE package_id = $package_id";
  $packages = mysqli_query($conn,$sql);
  $package = mysqli_fetch_assoc($packages);

  $name = $package['name'];
  $description = $package['description'];
  $daily_rate = $package['daily_rate'];
  $monthly_rate = $package['monthly_rate'];
  $hourly_rate = $package['hourly_rate'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>PAP's Fitness Gym - Edit Packages</title>
  </head>

  <body style="background-color: black; position: relative;">
    <header class="pt-16 pb-24 flex items-center px-52 justify-between">
      <div class="w-24 h-24 overflow-hidden">
        <img src="../../../public/images/logo.png" alt="Logo" class="w-full h-auto">
      </div>

      <p class="text-4xl font-bold text-[#fabf3b]">EDIT PACKAGES</p>

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
          onclick="window.location.href='auth/login.php'"
        >
          Manage Pricing
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
          Manage Billing
        </button>
      </div>
    </div>

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
          <p class="text-3xl text-black font-bold">Class Schedule</p>

          <form action="../../../controllers/packageController.php" method="POST" class="space-y-6 flex flex-col w-full">
            <input type="hidden" name="package_id" value="<?php echo $package_id ?>">
            <input type="hidden" name="daily_rate" value="<?php echo $daily_rate ?>">
            <input type="hidden" name="monthly_rate" value="<?php echo $monthly_rate ?>">
            <input type="hidden" name="hourly_rate" value="<?php echo $hourly_rate ?>">
            <input 
              name="name"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Package Name"
              value="<?php echo $name ?>"
            />

            <textarea 
              name="description"
              class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
              placeholder="Description"
            >
              <?php echo $description ?>
            </textarea>

            <div class="flex items-center space-x-4 w-full">
              <select 
                id="select-type"
                class="px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white w-32 pointer-events-none opacity-90"
              >
                <option value="daily" <?php echo !empty($daily_rate) ? 'selected' : ''; ?>>Daily</option>
                <option value="monthly" <?php echo !empty($monthly_rate) ? 'selected' : ''; ?>>Monthly</option>
                <option value="hourly" <?php echo !empty($hourly_rate) ? 'selected' : ''; ?>>Hourly</option>
              </select>

              <div id="input-container" class="w-full">
                <input 
                  class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
                  placeholder="Daily Rate"
                  value="
                    <?php echo $daily_rate ? $daily_rate : '' ?> 
                    <?php echo $monthly_rate ? $monthly_rate : '' ?> 
                    <?php echo $hourly_rate ? $hourly_rate : '' ?>
                  "
                />
              </div>
            </div>

            <button 
              class="bg-black px-5 py-3 text-black text-base font-medium rounded-lg w-full text-white"
              name="update"
            >
              Update
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>