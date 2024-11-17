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

if (is_array($memberships) && !empty($memberships) && $memberships[0]['expiration_date'] === $dateToday) {
  $membershipId = $memberships[0]['membership_id'];
  $renewable = "UPDATE memberships SET status = 'renewable', payment_status='renewable' WHERE membership_id = $membershipId";

  $conn->query($renewable);
}
?>

<div class="w-full flex flex-col items-center py-24 space-y-12">
  <p class="text-3xl font-bold text-[#fabf3b]">Join Paps Fitness Gym!</p>

  <p class="text-3xl font-bold text-[#fabf3b]">Affordable Membership</p>

  <?php if(empty($memberships)): ?>
    <div class="max-w-7xl w-full grid grid-cols-3 gap-x-12 gap-y-6">
      <?php foreach ($packages as $index => $package): ?>
        <div class="bg-[#fabf3b] w-full px-4 flex flex-col items-center pt-6 pb-3 space-y-6 relative">
          <p class="text-3xl font-bold z-[1] w-full bg-[#fabf3b] text-center"><?php echo $package['name'] ?></p>

          <p class="text-base font-medium text-center px-6 h-7">
            <?php echo $package['description'] ?>
          </p>

          <button 
            class="text-yellow-300 bg-black px-10 py-1.5 text-black text-sm font-medium rounded-sm"
            onclick="window.location.href='membership/create.php?package_id=<?php echo $package['package_id']?>'"
          >
            Join Now
          </button>
        </div>
      <?php endforeach ?>
    </div>
  <?php endif; ?>

  <?php if(!empty($memberships)): ?>
    <div class="max-w-xl w-full rounded-lg bg-[#fabf3b] flex flex-col items-start px-6 py-4 space-y-8">
      <div class="flex items-center justify-between w-full">
        <p class="text-2xl font-semibold">Active Membership</p>
        <p class="text-base font-semibold capitalize">
          <?php echo ($memberships[0]['payment_status'] === 'pending' && $memberships[0]['status'] !== 'active') ? 'requires payment' : 'paid' ?>
        </p>
      </div>

      <div class="w-full grid grid-cols-2 gap-y-4">
        <div class="space-y-1.5">
          <p class="text-base">Name:</p>
          <p class="text-base"><?php echo $memberships[0]['name'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Type:</p>
          <p class="text-base"><?php echo $memberships[0]['type'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Starting at:</p>
          <p class="text-base"><?php echo $memberships[0]['start_date'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Expired on::</p>
          <p class="text-base"><?php echo $memberships[0]['expiration_date'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Amount:</p>
          <p class="text-base"><?php echo $memberships[0]['amount'] ?></p>
        </div>

        <div class="space-y-1.5">
          <p class="text-base">Status:</p>
          <p class="text-base"><?php echo $memberships[0]['status'] ?></p>
        </div>
      </div>

      <?php if($memberships[0]['payment_status'] === 'pending' && $memberships[0]['status'] === 'pending'): ?>
        <div class="space-y-1.5 w-full">
          <button 
            class="text-white bg-red-600 justify-center w-full py-3 text-lg font-medium rounded-lg"
            onclick="window.location.href='payment/create.php?membership_id=<?php echo $memberships[0]['membership_id']?>'"
          >
            Pay Now
          </button>

          <form action='../../controllers/membershipController.php' method='POST'>
            <input type="hidden" name="membership_id" value="<?php echo $memberships[0]['membership_id']?>">
            <button 
              class="text-black bg-inherit justify-center w-full py-3 text-lg font-medium rounded-lg"
              name="cancel"
            >
              Cancel
            </button>
          </form>
        </div>
      <?php endif; ?>

      <?php if($memberships[0]['payment_status'] === 'paid'  && $memberships[0]['status'] === 'pending'): ?>
        <div class="space-y-1.5 w-full">
          <button 
            class="text-white bg-orange-600 justify-center w-full py-3 text-lg font-medium rounded-lg pointer-events-none"
          >
            Pending
          </button>

          <form action='../../controllers/membershipController.php' method='POST'>
            <input type="hidden" name="membership_id" value="<?php echo $memberships[0]['membership_id']?>">
            <button 
              class="text-black bg-inherit justify-center w-full py-3 text-lg font-medium rounded-lg"
              name="cancel"
            >
              Cancel
            </button>
          </form>
        </div>
      <?php endif; ?>

      <?php if($memberships[0]['payment_status'] === 'approve'  && $memberships[0]['status'] === 'active'): ?>
        <div class="space-y-1.5 w-full">
          <button 
            class="text-white bg-green-600 justify-center w-full py-3 text-lg font-medium rounded-lg pointer-events-none"
          >
            Active
          </button>

          <form action='../../controllers/membershipController.php' method='POST'>
            <input type="hidden" name="membership_id" value="<?php echo $memberships[0]['membership_id']?>">
            <button 
              class="text-black bg-inherit justify-center w-full py-3 text-lg font-medium rounded-lg"
              name="cancel"
            >
              End
            </button>
          </form>
        </div>
      <?php endif; ?>

      <?php if($memberships[0]['payment_status'] === 'renewable' && $memberships[0]['status'] === 'renewable'): ?>
        <button 
          class="text-white bg-blue-600 justify-center w-full py-3 text-lg font-medium rounded-lg pointer-events-none"
        >
          Renewable
        </button>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const packageElements = document.querySelectorAll('form');
    
    packageElements.forEach((form, index) => {
      const startDateInput = document.getElementById(`start-date-${index}`);
      const expirationDateInput = document.getElementById(`expiration-date-${index}`);
      
      let membershipType = '';
      if (form.dataset.dailyRate) {
        membershipType = 'daily';
      } else if (form.dataset.monthlyRate) {
        membershipType = 'monthly';
      } else if (form.dataset.hourlyRate) {
        membershipType = 'hourly';
      }

      function formatDate(date) {
        return date.toISOString().split('T')[0];
      }

      const today = new Date();
      startDateInput.value = formatDate(today);

      let expirationDate = new Date(today);

      if (membershipType === "daily") {
        expirationDate.setDate(expirationDate.getDate() + 1);
      } else if (membershipType === "monthly") {
        expirationDate.setDate(expirationDate.getDate() + 30);
      }

      expirationDateInput.value = formatDate(expirationDate);
    });
  });
</script>