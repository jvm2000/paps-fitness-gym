<?php
include "../../config/connect.php";

$title = 'Dashboard';
$pageHeader = 'Dashboard';
$childView = __DIR__ . '/home.php';

include('../../layouts/admin.php');

$memberships = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $date_from = $_POST['date_from'];
  $date_to = $_POST['date_to'];

  $sql = "SELECT memberships.*, users.* 
          FROM memberships LEFT JOIN users ON users.user_id = memberships.user_id 
          WHERE created_at BETWEEN '$date_from' AND '$date_to'";

  $result = mysqli_query($conn, $sql);

  if ($result->num_rows > 0) {
    while ($membership = $result->fetch_assoc()) {
      $memberships[] = $membership; 
    }
  }
}

$userCount = 0;
$sql = "SELECT COUNT(*) AS total FROM users";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $userCount = $row['total'];
}

$membershipCount = 0;
$sql = "SELECT COUNT(*) AS total FROM memberships";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $membershipCount = $row['total'];
}

$equipmentCount = 0;
$sql = "SELECT COUNT(*) AS total FROM equipments";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $equipmentCount = $row['total'];
}

$trainerCount = 0;
$sql = "SELECT COUNT(*) AS total FROM trainers";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $trainerCount = $row['total'];
}

$scheduleCount = 0;
$sql = "SELECT COUNT(*) AS total FROM schedules";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $scheduleCount = $row['total'];
}

$totalRevenue = 0;
$sql = "SELECT SUM(total_paid) AS total FROM payments";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $totalRevenue = $row['total'];
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-5xl w-full flex flex-col space-y-8 items-start">
    <div class="grid grid-cols-6 w-full items-center gap-8">
      <div class="px-6 py-4 bg-[#fabf3b] rounded-md col-span-2 space-y-2">
        <div class="flex items-center space-x-2">
          <img src="../../public/images/admin/user-icon.png" class="w-8 h-auto">
          <p class="text-4xl font-bold">Users</p>
        </div>

        <p class="text-xl font-medium"><?php echo $userCount ?> Total Users</p>
      </div>

      <div class="px-6 py-4 bg-[#fabf3b] rounded-md col-span-2 space-y-2">
        <div class="flex items-center space-x-2">
          <img src="../../public/images/admin/membership-icon.png" class="w-8 h-auto">
          <p class="text-4xl font-bold">Memberships</p>
        </div>

        <p class="text-xl font-medium"><?php echo $membershipCount ?> Total Memberships</p>
      </div>

      <div class="px-6 py-4 bg-[#fabf3b] rounded-md col-span-2 space-y-2">
        <div class="flex items-center space-x-2">
          <img src="../../public/images/admin/equipment-icon.png" class="w-9 h-auto">
          <p class="text-4xl font-bold">Equipments</p>
        </div>

        <p class="text-xl font-medium"><?php echo $equipmentCount ?> Total Equipments</p>
      </div>

      <div class="px-6 py-4 bg-[#fabf3b] rounded-md col-span-2 space-y-2">
        <div class="flex items-center space-x-2">
          <img src="../../public/images/admin/trainer-icon.png" class="w-9 h-auto">
          <p class="text-4xl font-bold">Trainers</p>
        </div>

        <p class="text-xl font-medium"><?php echo $trainerCount ?> Total Trainers</p>
      </div>

      <div class="px-6 py-4 bg-[#fabf3b] rounded-md col-span-2 space-y-2">
        <div class="flex items-center space-x-2">
          <img src="../../public/images/admin/schedule-icon.png" class="w-9 h-auto">
          <p class="text-4xl font-bold">Schedules</p>
        </div>

        <p class="text-xl font-medium"><?php echo $scheduleCount ?> Total Schedules</p>
      </div>

      <div class="px-6 py-4 bg-[#fabf3b] rounded-md col-span-2 space-y-2">
        <div class="flex items-center space-x-2">
          <img src="../../public/images/admin/revenue-icon.png" class="w-9 h-auto">
          <p class="text-4xl font-bold">All Revenue</p>
        </div>

        <p class="text-xl font-medium">P<?php echo $totalRevenue ?>.00</p>
      </div>
    </div>

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
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['firstname'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['lastname'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['email'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $membership['phone'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-black"><?php echo $membership['type'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>