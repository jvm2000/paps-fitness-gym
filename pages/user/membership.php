<?php
include "../../config/connect.php";

$title = "PAP's Fitness Gym - Home";
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
?>

<div class="w-full flex flex-col items-center py-24 space-y-12">
  <p class="text-3xl font-bold text-[#fabf3b]">Join Paps Fitness Gym!</p>

  <p class="text-3xl font-bold text-[#fabf3b]">Affordable Membership</p>

  <div class="max-w-7xl w-full grid grid-cols-3 gap-x-12 gap-y-6">
    <?php foreach ($packages as $index => $package): ?>
      <div class="bg-[#fabf3b] w-full px-4 flex flex-col items-center pt-6 pb-3 space-y-6 relative">
        <p class="text-3xl font-bold z-[1] w-full bg-[#fabf3b] text-center"><?php echo $package['name'] ?></p>

        <p class="text-base font-medium text-center px-6 h-7">
          <?php echo $package['description'] ?>
        </p>

        <button 
          class="text-yellow-300 bg-black px-10 py-1.5 text-black text-sm font-medium rounded-sm"
        >
          Join Now
        </button>
      </div>
    <?php endforeach ?>
  </div>
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