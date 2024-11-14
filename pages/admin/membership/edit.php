<?php
  session_start();
  include "../../../config/connect.php";

  if (!isset($_SESSION['admin_id'])) {
    error_log("User not logged in, redirecting to login page");

    header("Location: ../auth/admin-login.php");
    exit();
  }

  $membership_id = $_GET['membership_id'];

  $sql = "SELECT memberships.*, users.* FROM memberships LEFT JOIN users ON users.user_id = memberships.user_id WHERE membership_id = $membership_id";
  $memberships = mysqli_query($conn,$sql);
  $membership = mysqli_fetch_assoc($memberships);

  $name = $membership['firstname'] . ' ' . $membership['lastname'];
  $email = $membership['email'];
  $phone = $membership['phone'];
  $type = $membership['type'];
  $start_date = $membership['start_date'];
  $expiration_date = $membership['expiration_date'];
  $status = $membership['status'];
  $payment_status = $membership['payment_status'];
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
          onclick="window.location.href='membership.php'"
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
      <div class="max-w-xl w-full flex flex-col space-y-8 items-start">
        <div class="flex justify-end w-full">
          <button 
            class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='../membership.php'"
          >
            Back
          </button>
        </div>

        <div class="py-10 px-6 bg-[#fabf3b] flex flex-col items-center space-y-6 w-full">
          <p class="text-3xl text-black font-bold">Class Schedule</p>

          <div class="grid grid-cols-2 gap-6 w-full">
            <div class="space-y-1.5 justify-start">
              <p class="text-sm text-black">Full Name</p>
              <p class="text-sm text-black"><?php echo $name ?></p>
            </div>

            <div class="space-y-1.5 justify-start">
              <p class="text-sm text-black">Email</p>
              <p class="text-sm text-black"><?php echo $email ?></p>
            </div>

            <div class="space-y-1.5 justify-start">
              <p class="text-sm text-black">Phone</p>
              <p class="text-sm text-black"><?php echo $phone ?></p>
            </div>

            <div class="space-y-1.5 justify-start">
              <p class="text-sm text-black">Membership Type</p>
              <p class="text-sm text-black capitalize"><?php echo $type ?></p>
            </div>

            <div class="space-y-1.5 justify-start">
              <p class="text-sm text-black">Start Date</p>
              <p class="text-sm text-black"><?php echo $start_date ?></p>
            </div>

            <div class="space-y-1.5 justify-start">
              <p class="text-sm text-black">Expiration Date</p>
              <p class="text-sm text-black"><?php echo $expiration_date ?></p>
            </div>

            <form action="../../../controllers/membershipController.php" method="POST" class="col-span-2 space-y-6">
              <input type="hidden" name="membership_id" value="<?php echo $membership_id ?>">

              <div class="space-y-1.5 justify-start">
                <p class="text-sm text-black">Status</p>
                <select 
                  name="status" 
                  class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
                >
                  <option value="inactive" <?php echo $status === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                  <option value="active" <?php echo $status === 'active' ? 'selected' : ''; ?>>Active</option>
                </select>
              </div>

              <div class="space-y-1.5 justify-start">
                <p class="text-sm text-black">Payment Status</p>
                <select 
                  name="payment_status" 
                  class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md text-black bg-black text-white"
                >
                  <option value="pending" <?php echo $payment_status === 'pending' ? 'selected' : ''; ?>>Pending</option>
                  <option value="approved" <?php echo $payment_status === 'approved' ? 'selected' : ''; ?>>Approved</option>
                </select>
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
    </div>
  </body>
</html>