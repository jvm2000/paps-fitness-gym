<?php
include "../../config/connect.php";

$title = 'Equipments';
$pageHeader = 'Equipments';
$childView = __DIR__ . '/equipment.php';

include('../../layouts/user.php');

$sql = "SELECT * FROM equipments";

$result = mysqli_query($conn, $sql);

$equipments = [];

if ($result->num_rows > 0) {
  while ($equipment = $result->fetch_assoc()) {
    $equipments[] = $equipment; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center">
  <div class="max-w-full w-full grid grid-cols-5 gap-8">
    <?php foreach ($equipments as $equipment): ?>
      <div class="w-full bg-[#fabf3b] flex flex-col pb-2 rounded-lg">
        <img 
          src="<?php echo '../' . $equipment['image']; ?>"
          alt="<?php echo $equipment['name'] ?>"
          class="w-full h-44 object-cover"
        />

        <div class="space-y-1.5 px-4 py-2">
          <div class="flex items-center justify-between">
            <p class="text-base font-semibold"><?php echo $equipment['name'] ?></p>
            <p class="text-base font-medium">Qty: <?php echo $equipment['quantity'] ?></p>
          </div>

          <p class="text-base">Last Maintenance: <?php echo $equipment['last_maintenance'] ?></p>

          <p class="text-base">Due Maintenance: <?php echo $equipment['due_maintenance'] ?></p>

          <p class="text-base">Status: <?php echo $equipment['status'] ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>