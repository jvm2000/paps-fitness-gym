<?php
include "../../config/connect.php";

$title = 'Trainers';
$pageHeader = 'Trainers';
$childView = __DIR__ . '/trainers.php';

include('../../layouts/user.php');

$sql = "SELECT * FROM trainers";

$result = mysqli_query($conn, $sql);

$trainers = [];

if ($result->num_rows > 0) {
  while ($trainer = $result->fetch_assoc()) {
    $trainers[] = $trainer; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-full w-full flex flex-col space-y-8 items-start">
    <div class="w-full rounded-md bg-[#fabf3b]">
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="py-4 border-b border-r border-black">Trainer ID</th>
            <th class="py-4 border-b border-r border-black">Image</th>
            <th class="py-4 border-b border-r border-black">Name</th>
            <th class="py-4 border-b border-r border-black">Specialty</th>
            <th class="py-4 border-b border-r border-black">Experience</th>
            <th class="py-4 border-b border-r border-black">Hourly Rate</th>
            <th class="py-4 border-b border-black">Availability</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($trainers as $trainer): ?>
            <tr>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['trainer_id'] ?></td>
              <td class="text-base text-left text-black indent-4 border-b border-r border-black">
                <img src="<?php echo '../' . $trainer['image']; ?>" class="w-full h-24 object-cover">
              </td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['name'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['specialty'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['experience'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $trainer['hourly_rate'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-black text-center">
                <?php echo $trainer['day_from'] ?> - <?php echo $trainer['day_to'] ?> : 
                <?php echo date('g:i A', strtotime($trainer['time_from'])) . ' - ' . date('g:i A', strtotime($trainer['time_to']));?>
              </td>
            </tr>
          <?php endforeach;  ?>
        </tbody>
      </table>
    </div>
  </div>
</div>