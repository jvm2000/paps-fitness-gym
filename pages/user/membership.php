<?php
include "../../config/connect.php";

$title = "Membership";
$pageHeader = "Membership";
$childView = __DIR__ . '/membership.php';

include('../../layouts/user.php');

$userID = $_SESSION['user_id'];

$sql = "SELECT * FROM packages";

$result = mysqli_query($conn, $sql);

$packages = [];

if ($result->num_rows > 0) {
  while ($package = $result->fetch_assoc()) {
    $packages[] = $package; 
  }
}

$sql = "SELECT memberships.*, packages.* FROM memberships LEFT JOIN packages ON packages.package_id = memberships.package_id WHERE user_id = $userID";

$result = mysqli_query($conn, $sql);

$memberships = [];

if ($result->num_rows > 0) {
  while ($membership = $result->fetch_assoc()) {
    $memberships[] = $membership; 
  }
}

$dateToday = date("Y-m-d");
?>

<div class="w-full flex flex-col items-center space-y-12">
  <div class="px-52 w-full flex flex-col items-center py-16">
    <div class="max-w-7xl w-full flex flex-col space-y-8 items-start">
      <div class="flex justify-end w-full">
        <button 
          class="bg-[#fabf3b] px-5 py-2 text-black text-sm font-medium rounded-sm"
          onclick="window.location.href='membership/create.php'"
        >
          Add Membership
        </button>
      </div>

      <div class="w-full rounded-md bg-[#fabf3b]">
        <table class="w-full table-auto">
          <thead>
            <tr>
              <th class="py-4 border-b border-r border-black">Type of Service</th>
              <th class="py-4 border-b border-r border-black">Type of Membership</th>
              <th class="py-4 border-b border-r border-black">Expiry Date</th>
              <th class="py-4 border-b border-r border-black">Status</th>
              <th class="py-4 border-b border-r border-black">Amount</th>
              <th class="py-4 border-b border-black">Actions</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($memberships as $membership): ?>
              <tr>
                <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['service_type'] ?></td>
                <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['type'] ?></td>
                <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['expiration_date'] ?></td>
                <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['status'] ?></td>
                <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['amount'] ?></td>
                <td class="py-4 text-base text-left text-black indent-4 border-b border-black space-y-1">
                  <?php if($membership['payment_status'] === 'pending' && $membership['status'] === 'pending'): ?>
                    <button 
                      class="text-white bg-red-600 justify-center py-1.5 px-2 text-xs font-medium rounded-lg"
                      onclick="window.location.href='payment/create.php?membership_id=<?php echo $membership['membership_id']?>'"
                    >
                      Pay
                    </button>
                  <?php endif; ?>

                  <?php if($membership['payment_status'] === 'paid' && $membership['status'] === 'pending'): ?>
                    <button 
                      class="text-white bg-red-600 justify-center py-1.5 px-2 text-xs font-medium rounded-lg"
                      disabled
                    >
                      Payment Submitted
                    </button>
                  <?php endif; ?>

                  <button 
                    class="text-white bg-red-600 justify-center py-1.5 px-2 text-xs font-medium rounded-lg disabled:bg-gray-500"
                    onclick="window.location.href='payment/renew.php?membership_id=<?php echo $membership['membership_id']?>'"
                    <?php echo ($membership['expiration_date'] !== $dateToday) ? 'disabled' : ''; ?>
                  >
                    <?php echo ($membership['expiration_date'] !== $dateToday) ? 'Not Renewable yet' : 'Renew'; ?>
                  </button>


                  <form action='../../controllers/membershipController.php' method='POST'>
                    <input type="hidden" name="membership_id" value="<?php echo $memberships[0]['membership_id']?>">
                    <button 
                      class="text-white bg-gray-600 justify-center py-1.5 px-2 text-xs font-medium rounded-lg"
                      name="cancel"
                    >
                      Cancel
                    </button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>