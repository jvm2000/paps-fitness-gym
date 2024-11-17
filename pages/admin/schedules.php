<?php
include "../../config/connect.php";

$title = 'Schedules';
$pageHeader = 'Schedules';
$childView = __DIR__ . '/schedules.php';

include('../../layouts/admin.php');

$sql = "SELECT trainers.*, trainers.name AS trainer_name, users.*, schedules.* 
        FROM schedules 
        LEFT JOIN trainers ON trainers.trainer_id = schedules.trainer_id 
        LEFT JOIN users ON users.user_id = schedules.user_id";

$result = mysqli_query($conn, $sql);

$schedules = [];

if ($result->num_rows > 0) {
  while ($schedule = $result->fetch_assoc()) {
    $schedules[] = $schedule; 
  }
}
?>

<div class="px-52 w-full flex flex-col items-center py-16">
  <div class="max-w-6xl w-full flex flex-col space-y-8 items-start">
    <div class="w-full rounded-md bg-[#fabf3b]">
      <table class="w-full table-auto">
        <thead>
          <tr>
            <th class="py-4 border-b border-r border-black">Appointed by</th>
            <th class="py-4 border-b border-r border-black">Assigned To</th>
            <th class="py-4 border-b border-r border-black">Class Name</th>
            <th class="py-4 border-b border-r border-black">Sched</th>
            <th class="py-4 border-b border-r border-black">Status</th>
            <th class="py-4 border-b border-black">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach ($schedules as $schedule): ?>
            <tr>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black">
                <?php echo $schedule['trainer_name'] ?>
              </td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black">
                <?php echo $schedule['firstname'] . ' ' . $schedule['lastname'] ?>
              </td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $schedule['name'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black capitalize">
                Days: <?php echo $schedule['day_from'] . ' - ' . $schedule['day_to'] ?> /
                Time: <?php echo $schedule['time_from'] . ' - ' . $schedule['time_to'] ?>
              </td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-r border-black"><?php echo $schedule['status'] ?></td>
              <td class="py-4 text-base text-left text-black indent-4 border-b border-black">
                <p>
                  <a href="schedule/edit.php?schedule_id=<?php echo $schedule['schedule_id']?>">Edit</a> 
                  <span>-</span>

                  <form action='../../controllers/scheduleController.php' method='POST'>
                    <input type="hidden" name="schedule_id" value="<?php echo $schedule['schedule_id']?>">
                    <button type="submit" name="delete">Delete</button> 
                  </form>
                </p>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>