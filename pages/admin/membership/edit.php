<?php
include "../../../config/connect.php";

$title = "About Membership";
$pageHeader = "About Membership";
$childView = __DIR__ . '/edit.php';
$noHeader = true;

include('../../../layouts/admin.php');

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

<div class="px-52 w-full flex flex-col items-center">
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
      <p class="text-3xl text-black font-bold">Manage Membership</p>

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
              <option value="pending" <?php echo $payment_status === 'paid' ? 'selected' : ''; ?>>Pending</option>
              <option value="approve" <?php echo $payment_status === 'approve' ? 'selected' : ''; ?>>Approve</option>
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