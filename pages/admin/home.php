<?php
include "../../config/connect.php";

$title = 'Dashboard';
$pageHeader = 'Dashboard';
$childView = __DIR__ . '/home.php';

include('../../layouts/admin.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $date_from = $_POST['date_from'];
  $date_to = $_POST['date_to'];

  // $date_from = date('Y-m-d', strtotime($date_from));
  // $date_to = date('Y-m-d', strtotime($date_to));

  $sql = "SELECT * FROM memberships WHERE created_at BETWEEN '$date_from' AND '$date_to'";
}

$memberships = [];

$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  while ($membership = $result->fetch_assoc()) {
    $memberships[] = $membership; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-5xl w-full flex flex-col space-y-8 items-start">
    <form action="home.php" method="POST" class="w-full rounded-md bg-[#fabf3b] px-16 py-4 space-y-6">
      <p class="text-4xl font-bold">Register Report</p>

      <div class="w-full flex items-center justify-between">
        <div class="space-y-1.5 justify-start">
          <p class="text-base font-medium">From Date</p>
          <input 
            type="date" 
            name="date_from" 
            class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          />
        </div>

        <div class="space-y-1.5 justify-start">
          <p class="text-base font-medium">To Date</p>
          <input 
            type="date" 
            name="date_to" 
            class="w-full px-4 py-2.5 ring-[1px] ring-black text-base rounded-md bg-black text-white"
          />
        </div>
      </div>

      <button 
        class="bg-black px-5 py-2.5 rounded-lg text-white font-medium"
        type="submit"
      >
        Submit
      </button>
    </form>

    <div class="w-full rounded-md bg-[#fabf3b]">
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="py-4 border-b border-r border-black">Member ID</th>
            <th class="py-4 border-b border-r border-black">First Name</th>
            <th class="py-4 border-b border-r border-black">Last Name</th>
            <th class="py-4 border-b border-r border-black">Email</th>
            <th class="py-4 border-b border-r border-black">Phone</th>
            <th class="py-4 border-b border-r border-black">Membership Type</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($memberships as $membership): ?>
            <tr>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['membership_id'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>